<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Client;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            // Admin voit toutes les tâches
            $tasks = Task::with(['assignedTo', 'assignedBy', 'client'])
                ->latest()
                ->paginate(15);
        } else {
            // Employé voit seulement ses tâches
            $tasks = $user->assignedTasks()
                ->with(['assignedBy', 'client'])
                ->latest()
                ->paginate(15);
        }
        
        $employees = User::where('role', 'employee')->get();
        $clients = Client::orderBy('last_name')->orderBy('first_name')->get();
        
        return view('tasks.index', compact('tasks', 'employees', 'clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high,urgent',
            'assigned_to' => 'required|exists:users,id',
            'client_id' => 'nullable|exists:clients,id',
            'due_date' => 'nullable|date|after_or_equal:today',
            'notes' => 'nullable|string|max:1000'
        ]);

        $validated['assigned_by'] = Auth::id();

        $task = Task::create($validated);

        // Notifier l'employé assigné
        $this->notifyEmployeeOfNewTask($task);

        return back()->with('status', 'Tâche assignée avec succès.');
    }

    public function update(Request $request, Task $task)
    {
        $user = Auth::user();
        
        // Vérifier les permissions
        if (!$user->isAdmin() && $task->assigned_to !== $user->id) {
            abort(403, 'Accès non autorisé.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high,urgent',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'client_id' => 'nullable|exists:clients,id',
            'due_date' => 'nullable|date',
            'notes' => 'nullable|string|max:1000'
        ]);

        // Si l'employé marque comme terminé, ajouter la date de completion
        if ($validated['status'] === 'completed' && $task->status !== 'completed') {
            $validated['completed_at'] = now();
        }

        $task->update($validated);

        // Notifier l'admin si l'employé change le statut
        if ($user->isEmployee() && $task->assigned_by !== $user->id) {
            $this->notifyAdminOfTaskUpdate($task);
        }

        return back()->with('status', 'Tâche mise à jour avec succès.');
    }

    public function destroy(Task $task)
    {
        $user = Auth::user();
        
        // Seul l'admin qui a créé la tâche peut la supprimer
        if (!$user->isAdmin() || $task->assigned_by !== $user->id) {
            abort(403, 'Accès non autorisé.');
        }

        $task->delete();
        return back()->with('status', 'Tâche supprimée avec succès.');
    }

    public function assign(Request $request)
    {
        $validated = $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'assigned_to' => 'required|exists:users,id'
        ]);

        $task = Task::findOrFail($validated['task_id']);
        $oldAssignee = $task->assigned_to;
        
        $task->update(['assigned_to' => $validated['assigned_to']]);

        // Notifier le nouvel assigné
        $this->notifyEmployeeOfTaskReassignment($task, $oldAssignee);

        return back()->with('status', 'Tâche réassignée avec succès.');
    }

    public function myTasks()
    {
        $user = Auth::user();
        $tasks = $user->assignedTasks()
            ->with(['assignedBy', 'client'])
            ->latest()
            ->paginate(15);
        
        return view('tasks.my-tasks', compact('tasks'));
    }

    public function updateStatus(Request $request, Task $task)
    {
        $user = Auth::user();
        
        // Seul l'employé assigné peut changer le statut
        if ($task->assigned_to !== $user->id) {
            abort(403, 'Accès non autorisé.');
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,completed,cancelled'
        ]);

        // Ajouter la date de completion si marqué comme terminé
        if ($validated['status'] === 'completed' && $task->status !== 'completed') {
            $validated['completed_at'] = now();
        }

        $task->update($validated);

        // Notifier l'admin
        $this->notifyAdminOfTaskUpdate($task);

        return back()->with('status', 'Statut de la tâche mis à jour.');
    }

    private function notifyEmployeeOfNewTask($task)
    {
        Notification::createAppointmentNotification(
            $task->assigned_to,
            'task_assigned',
            'Nouvelle Tâche Assignée',
            "Une nouvelle tâche vous a été assignée : {$task->title}",
            ['task_id' => $task->id, 'priority' => $task->priority]
        );
    }

    private function notifyEmployeeOfTaskReassignment($task, $oldAssignee)
    {
        Notification::createAppointmentNotification(
            $task->assigned_to,
            'task_reassigned',
            'Tâche Réassignée',
            "La tâche '{$task->title}' vous a été réassignée",
            ['task_id' => $task->id]
        );
    }

    private function notifyAdminOfTaskUpdate($task)
    {
        if ($task->assignedBy) {
            Notification::createAppointmentNotification(
                $task->assigned_by,
                'task_updated',
                'Tâche Mise à Jour',
                "La tâche '{$task->title}' assignée à {$task->assignedTo->name} a été mise à jour. Nouveau statut : " . ucfirst($task->status),
                ['task_id' => $task->id, 'status' => $task->status]
            );
        }
    }
}