<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Appointment;
use App\Models\Proforma;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DataImportExportController extends Controller
{
    /**
     * Afficher la page d'import/export
     */
    public function index()
    {
        return view('admin.data-import-export.index');
    }

    /**
     * Exporter les clients en CSV
     */
    public function exportClients()
    {
        $clients = Client::with('appointments', 'proformas')->get();
        
        $filename = 'clients_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($clients) {
            $file = fopen('php://output', 'w');
            
            // En-têtes CSV
            fputcsv($file, [
                'ID',
                'Nom',
                'Prénom',
                'Email',
                'Téléphone',
                'Âge',
                'Chiffre d\'affaires (FCFA)',
                'Nombre de RDV',
                'Nombre de proformas',
                'Date de création',
                'Dernière mise à jour'
            ]);

            // Données
            foreach ($clients as $client) {
                fputcsv($file, [
                    $client->id,
                    $client->last_name,
                    $client->first_name,
                    $client->email,
                    $client->phone,
                    $client->age,
                    $client->revenue,
                    $client->appointments->count(),
                    $client->proformas->count(),
                    $client->created_at->format('d/m/Y H:i'),
                    $client->updated_at->format('d/m/Y H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Exporter les rendez-vous en CSV
     */
    public function exportAppointments()
    {
        $appointments = Appointment::with('client')->get();
        
        $filename = 'appointments_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($appointments) {
            $file = fopen('php://output', 'w');
            
            // En-têtes CSV
            fputcsv($file, [
                'ID',
                'Client',
                'Date et heure',
                'Type',
                'Statut',
                'Notes',
                'Créé par',
                'Date de création'
            ]);

            // Données
            foreach ($appointments as $appointment) {
                fputcsv($file, [
                    $appointment->id,
                    $appointment->client ? $appointment->client->first_name . ' ' . $appointment->client->last_name : 'N/A',
                    $appointment->appointment_date->format('d/m/Y H:i'),
                    $appointment->type,
                    $appointment->status,
                    $appointment->notes,
                    $appointment->created_by,
                    $appointment->created_at->format('d/m/Y H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Exporter les proformas en CSV
     */
    public function exportProformas()
    {
        $proformas = Proforma::with('client')->get();
        
        $filename = 'proformas_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($proformas) {
            $file = fopen('php://output', 'w');
            
            // En-têtes CSV
            fputcsv($file, [
                'ID',
                'Client',
                'Montant total (FCFA)',
                'Statut',
                'Date de création',
                'Date d\'échéance',
                'Notes'
            ]);

            // Données
            foreach ($proformas as $proforma) {
                fputcsv($file, [
                    $proforma->id,
                    $proforma->client ? $proforma->client->first_name . ' ' . $proforma->client->last_name : 'N/A',
                    $proforma->total_amount,
                    $proforma->status,
                    $proforma->created_at->format('d/m/Y H:i'),
                    $proforma->due_date ? $proforma->due_date->format('d/m/Y') : 'N/A',
                    $proforma->notes
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Exporter les tâches en CSV
     */
    public function exportTasks()
    {
        $tasks = Task::with('assignedTo', 'client')->get();
        
        $filename = 'tasks_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($tasks) {
            $file = fopen('php://output', 'w');
            
            // En-têtes CSV
            fputcsv($file, [
                'ID',
                'Titre',
                'Description',
                'Client',
                'Assigné à',
                'Priorité',
                'Statut',
                'Date d\'échéance',
                'Date de création'
            ]);

            // Données
            foreach ($tasks as $task) {
                fputcsv($file, [
                    $task->id,
                    $task->title,
                    $task->description,
                    $task->client ? $task->client->first_name . ' ' . $task->client->last_name : 'N/A',
                    $task->assignedTo ? $task->assignedTo->name : 'N/A',
                    $task->priority,
                    $task->status,
                    $task->due_date ? $task->due_date->format('d/m/Y') : 'N/A',
                    $task->created_at->format('d/m/Y H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Importer des clients depuis un CSV
     */
    public function importClients(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|file|mimes:csv,txt|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error', 'Fichier CSV invalide.');
        }

        $file = $request->file('csv_file');
        $handle = fopen($file->getPathname(), 'r');
        
        // Lire la première ligne (en-têtes)
        $headers = fgetcsv($handle);
        
        $imported = 0;
        $errors = [];

        while (($data = fgetcsv($handle)) !== false) {
            try {
                Client::create([
                    'last_name' => $data[0] ?? '',
                    'first_name' => $data[1] ?? '',
                    'email' => $data[2] ?? '',
                    'phone' => $data[3] ?? '',
                    'age' => is_numeric($data[4]) ? (int)$data[4] : null,
                    'revenue' => is_numeric($data[5]) ? (float)$data[5] : 0,
                ]);
                $imported++;
            } catch (\Exception $e) {
                $errors[] = "Ligne " . ($imported + 1) . ": " . $e->getMessage();
            }
        }

        fclose($handle);

        $message = "Import terminé. {$imported} clients importés.";
        if (!empty($errors)) {
            $message .= " Erreurs: " . implode(', ', $errors);
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Obtenir les statistiques d'export
     */
    public function getExportStats()
    {
        $stats = [
            'clients' => Client::count(),
            'appointments' => Appointment::count(),
            'proformas' => Proforma::count(),
            'tasks' => Task::count(),
            'total_revenue' => Client::sum('revenue'),
            'active_clients' => Client::where('revenue', '>', 0)->count(),
        ];

        return response()->json($stats);
    }
}