<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Appointment;
use App\Models\Task;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
  public function index(Request $request)
  {
    $user = $request->user();
    $totalClients = Client::count();
    $companyRevenue = Client::sum('revenue');

    $openAppointments = Appointment::where('status', 'planned')->count();
    $overdueAppointments = Appointment::where('status', 'planned')
      ->where('scheduled_at', '<', now())
      ->count();

    $now = now();
    $lastMonth = (clone $now)->subMonth();

    $newClientsThisMonth = Client::whereYear('created_at', $now->year)
      ->whereMonth('created_at', $now->month)
      ->count();
    $newClientsLastMonth = Client::whereYear('created_at', $lastMonth->year)
      ->whereMonth('created_at', $lastMonth->month)
      ->count();
    $clientsGrowthPct = $newClientsLastMonth > 0
      ? (int) round((($newClientsThisMonth - $newClientsLastMonth) / max(1, $newClientsLastMonth)) * 100)
      : ($newClientsThisMonth > 0 ? 100 : 0);

    $revenueThisMonth = Client::whereYear('created_at', $now->year)
      ->whereMonth('created_at', $now->month)
      ->sum('revenue');
    $revenueLastMonth = Client::whereYear('created_at', $lastMonth->year)
      ->whereMonth('created_at', $lastMonth->month)
      ->sum('revenue');
    $revenueDelta = (int) ($revenueThisMonth - $revenueLastMonth);

    $goalAmount = 6000000; // objectif trimestriel exemple
    $quarterAmount = $companyRevenue; // simplifié: utiliser CA actuel comme perf
    $progressPct = $goalAmount > 0 ? (int) min(100, round(($quarterAmount / $goalAmount) * 100)) : 0;

    $metrics = [
      'activeClients' => $totalClients,
      'openOpportunities' => $openAppointments,
      'overdueTasks' => $overdueAppointments,
      'revenueMonth' => (int) $revenueThisMonth,
      'revenueDelta' => $revenueDelta,
      'activeClientsGrowthPct' => $clientsGrowthPct,
      'openOpportunitiesDelta' => 0,
      'overdueTasksDelta' => 0,
      'revenueProgressPct' => $progressPct,
    ];

    $sales = [
      'quarterAmount' => (int) $quarterAmount,
      'goalAmount' => (int) $goalAmount,
      'progressPct' => $progressPct,
    ];

    $pipeline = [
      ['label' => 'Planifiés', 'percent' => 0, 'color' => 'bg-primary'],
      ['label' => 'Effectués', 'percent' => 0, 'color' => 'bg-success'],
      ['label' => 'Annulés', 'percent' => 0, 'color' => 'bg-danger'],
      ['label' => 'En retard', 'percent' => 0, 'color' => 'bg-warning'],
    ];

    $totalForPct = max(1, Appointment::count());
    $plannedCount = Appointment::where('status', 'planned')->count();
    $doneCount = Appointment::where('status', 'done')->count();
    $canceledCount = Appointment::where('status', 'canceled')->count();
    $lateCount = $overdueAppointments;
    $pipeline[0]['percent'] = (int) round(($plannedCount / $totalForPct) * 100);
    $pipeline[1]['percent'] = (int) round(($doneCount / $totalForPct) * 100);
    $pipeline[2]['percent'] = (int) round(($canceledCount / $totalForPct) * 100);
    $pipeline[3]['percent'] = (int) round(($lateCount / $totalForPct) * 100);

    $recentAppointments = Appointment::with('client')
      ->latest('scheduled_at')
      ->limit(10)
      ->get();

    $activities = $recentAppointments->map(function ($appt) {
      $status = (string) $appt->status;
      if ($status === 'done') {
        $label = 'Terminé';
        $class = 'text-bg-success';
      } elseif ($status === 'canceled') {
        $label = 'Annulé';
        $class = 'text-bg-danger';
      } else {
        $label = 'Planifié';
        $class = 'text-bg-primary';
      }

      return [
        'date' => optional($appt->scheduled_at)->format('d/m/Y H:i') ?? '',
        'type' => 'RDV',
        'client' => optional($appt->client)->last_name . ' ' . optional($appt->client)->first_name,
        'detail' => $appt->subject,
        'status' => [
          'label' => $label,
          'class' => $class,
        ],
      ];
    })->toArray();

    $clients = Client::with(['appointments' => function($q){ $q->latest()->limit(3); }, 'notes' => function($q){ $q->latest()->limit(3); }])
      ->latest()->paginate(10);

    // Statistiques des tâches
    $taskStats = [];
    if ($user->isAdmin()) {
      $taskStats = [
        'total' => Task::count(),
        'pending' => Task::where('status', 'pending')->count(),
        'in_progress' => Task::where('status', 'in_progress')->count(),
        'completed' => Task::where('status', 'completed')->count(),
        'overdue' => Task::where('due_date', '<', now())->where('status', '!=', 'completed')->count()
      ];
    } else {
      $taskStats = [
        'total' => $user->assignedTasks()->count(),
        'pending' => $user->pendingTasks()->count(),
        'in_progress' => $user->inProgressTasks()->count(),
        'completed' => $user->completedTasks()->count(),
        'overdue' => $user->assignedTasks()->where('due_date', '<', now())->where('status', '!=', 'completed')->count()
      ];
    }

    // Hide revenue data for employees
    if ($user->isEmployee()) {
      $companyRevenue = null;
      $metrics['revenueMonth'] = 0;
      $metrics['revenueDelta'] = 0;
      $metrics['revenueProgressPct'] = 0;
      $sales['quarterAmount'] = 0;
      $sales['goalAmount'] = 0;
      $sales['progressPct'] = 0;
    }

    return view('welcome', compact('metrics', 'sales', 'pipeline', 'activities', 'clients', 'companyRevenue', 'user', 'taskStats'));
  }
}


