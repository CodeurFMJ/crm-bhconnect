<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;
use App\Models\Client;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    public function run()
    {
        // Récupérer un admin et un employé
        $admin = User::where('role', 'admin')->first();
        $employee = User::where('role', 'employee')->first();
        
        if (!$admin || !$employee) {
            $this->command->warn('Admin ou employé non trouvé. Création des tâches ignorée.');
            return;
        }

        // Récupérer un client
        $client = Client::first();
        if (!$client) {
            $client = Client::create([
                'first_name' => 'Client',
                'last_name' => 'Test',
                'email' => 'client@test.com',
                'phone' => '+237 123 456 789',
                'company' => 'Entreprise Test',
                'revenue' => 100000
            ]);
        }

        // Créer quelques tâches de test
        $tasks = [
            [
                'title' => 'Appeler le client pour confirmer le RDV',
                'description' => 'Contacter le client pour confirmer le rendez-vous de demain et s\'assurer qu\'il est toujours disponible.',
                'priority' => 'high',
                'status' => 'pending',
                'assigned_to' => $employee->id,
                'assigned_by' => $admin->id,
                'client_id' => $client->id,
                'due_date' => Carbon::today()->addDay(),
                'notes' => 'Important: vérifier la disponibilité avant de confirmer'
            ],
            [
                'title' => 'Préparer la présentation du nouveau produit',
                'description' => 'Créer une présentation PowerPoint pour le nouveau produit à présenter lors de la réunion de vendredi.',
                'priority' => 'medium',
                'status' => 'in_progress',
                'assigned_to' => $employee->id,
                'assigned_by' => $admin->id,
                'client_id' => null,
                'due_date' => Carbon::today()->addDays(3),
                'notes' => 'Inclure les spécifications techniques et les avantages concurrentiels'
            ],
            [
                'title' => 'Mettre à jour la base de données clients',
                'description' => 'Vérifier et mettre à jour les informations de contact des clients dans la base de données.',
                'priority' => 'low',
                'status' => 'pending',
                'assigned_to' => $employee->id,
                'assigned_by' => $admin->id,
                'client_id' => null,
                'due_date' => Carbon::today()->addWeek(),
                'notes' => 'Se concentrer sur les clients actifs des 6 derniers mois'
            ],
            [
                'title' => 'Analyser les performances du trimestre',
                'description' => 'Analyser les données de vente du trimestre et préparer un rapport pour la direction.',
                'priority' => 'urgent',
                'status' => 'pending',
                'assigned_to' => $employee->id,
                'assigned_by' => $admin->id,
                'client_id' => null,
                'due_date' => Carbon::today()->addDays(2),
                'notes' => 'Deadline stricte pour la réunion de direction'
            ],
            [
                'title' => 'Organiser la formation équipe',
                'description' => 'Planifier et organiser une session de formation pour l\'équipe sur les nouvelles procédures.',
                'priority' => 'medium',
                'status' => 'completed',
                'assigned_to' => $employee->id,
                'assigned_by' => $admin->id,
                'client_id' => null,
                'due_date' => Carbon::yesterday(),
                'notes' => 'Formation terminée avec succès',
                'completed_at' => Carbon::yesterday()->setTime(16, 30)
            ]
        ];

        foreach ($tasks as $taskData) {
            Task::create($taskData);
        }
    }
}