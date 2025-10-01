<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('client')->latest('scheduled_at')->paginate(15);
        $clients = Client::orderBy('last_name')->orderBy('first_name')->get(['id','first_name','last_name']);
        return view('appointments.index', compact('appointments','clients'));
    }
    public function store(Request $request, Client $client)
    {
        $validated = $request->validate([
            'scheduled_at' => ['required','date'],
            'subject' => ['required','string','max:255'],
            'details' => ['nullable','string'],
            'status' => ['nullable','in:planned,done,canceled'],
        ]);

        $validated['created_by'] = Auth::id();
        $validated['approval_status'] = Auth::user()->isEmployee() ? 'pending' : 'approved';

        $appointment = $client->appointments()->create($validated);

        // Notifier les admins si c'est un employé qui crée le RDV
        if (Auth::user()->isEmployee()) {
            $this->notifyAdminsOfNewAppointment($appointment);
        }

        return back()->with('status','RDV enregistré.');
    }

    public function update(Request $request, Client $client, Appointment $appointment)
    {
        $validated = $request->validate([
            'scheduled_at' => ['required','date'],
            'subject' => ['required','string','max:255'],
            'details' => ['nullable','string'],
            'status' => ['required','in:planned,done,canceled'],
        ]);

        $appointment->update($validated);
        return back()->with('status','RDV mis à jour.');
    }

    public function destroy(Client $client, Appointment $appointment)
    {
        $appointment->delete();
        return back()->with('status','RDV supprimé.');
    }

    public function approve(Request $request, Appointment $appointment)
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        $appointment->update([
            'approval_status' => 'approved',
            'approved_by' => Auth::id(),
            'admin_notes' => $request->admin_notes,
            'approved_at' => now()
        ]);

        // Notifier l'employé qui a créé le RDV
        if ($appointment->creator) {
            Notification::createAppointmentNotification(
                $appointment->creator->id,
                'appointment_approved',
                'RDV Approuvé',
                "Votre rendez-vous avec {$appointment->client->first_name} {$appointment->client->last_name} a été approuvé.",
                ['appointment_id' => $appointment->id]
            );
        }

        return back()->with('status', 'RDV approuvé avec succès.');
    }

    public function reject(Request $request, Appointment $appointment)
    {
        $request->validate([
            'admin_notes' => 'required|string|max:1000'
        ]);

        $appointment->update([
            'approval_status' => 'rejected',
            'approved_by' => Auth::id(),
            'admin_notes' => $request->admin_notes,
            'approved_at' => now()
        ]);

        // Notifier l'employé qui a créé le RDV
        if ($appointment->creator) {
            Notification::createAppointmentNotification(
                $appointment->creator->id,
                'appointment_rejected',
                'RDV Rejeté',
                "Votre rendez-vous avec {$appointment->client->first_name} {$appointment->client->last_name} a été rejeté. Raison: {$request->admin_notes}",
                ['appointment_id' => $appointment->id]
            );
        }

        return back()->with('status', 'RDV rejeté.');
    }

    public function reschedule(Request $request, Appointment $appointment)
    {
        $request->validate([
            'rescheduled_to' => 'required|date|after:now',
            'admin_notes' => 'required|string|max:1000'
        ]);

        $appointment->update([
            'approval_status' => 'rescheduled',
            'approved_by' => Auth::id(),
            'admin_notes' => $request->admin_notes,
            'rescheduled_to' => $request->rescheduled_to,
            'approved_at' => now()
        ]);

        // Notifier l'employé qui a créé le RDV
        if ($appointment->creator) {
            Notification::createAppointmentNotification(
                $appointment->creator->id,
                'appointment_rescheduled',
                'RDV Reporté',
                "Votre rendez-vous avec {$appointment->client->first_name} {$appointment->client->last_name} a été reporté au " . \Carbon\Carbon::parse($request->rescheduled_to)->format('d/m/Y H:i') . ". Raison: {$request->admin_notes}",
                ['appointment_id' => $appointment->id, 'new_date' => $request->rescheduled_to]
            );
        }

        return back()->with('status', 'RDV reporté avec succès.');
    }

    public function pending()
    {
        $appointments = Appointment::with(['client', 'creator'])
            ->where('approval_status', 'pending')
            ->latest('created_at')
            ->paginate(15);
        
        return view('appointments.pending', compact('appointments'));
    }

    private function notifyAdminsOfNewAppointment($appointment)
    {
        $admins = User::where('role', 'admin')->get();
        
        foreach ($admins as $admin) {
            Notification::createAppointmentNotification(
                $admin->id,
                'appointment_created',
                'Nouveau RDV à Approuver',
                "Un nouveau rendez-vous a été créé par {$appointment->creator->name} avec {$appointment->client->first_name} {$appointment->client->last_name} pour le " . $appointment->scheduled_at->format('d/m/Y H:i'),
                ['appointment_id' => $appointment->id]
            );
        }
    }
}


