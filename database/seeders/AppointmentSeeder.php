<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;

class AppointmentSeeder extends Seeder
{
    public function run()
    {
        // Créer quelques clients de test s'ils n'existent pas
        $clients = Client::first();
        if (!$clients) {
            $clients = Client::create([
                'first_name' => 'Jean',
                'last_name' => 'Dupont',
                'email' => 'jean.dupont@example.com',
                'phone' => '+237 123 456 789',
                'company' => 'Entreprise Test',
                'revenue' => 500000
            ]);
        }

        // Créer un employé de test
        $employee = User::where('role', 'employee')->first();
        if (!$employee) {
            $employee = User::create([
                'name' => 'Employé Test',
                'email' => 'employee@test.com',
                'password' => bcrypt('password'),
                'role' => 'employee'
            ]);
        }

        // Créer quelques RDV de test
        $appointments = [
            [
                'client_id' => $clients->id,
                'scheduled_at' => Carbon::now()->addDays(1)->setTime(9, 0),
                'subject' => 'Réunion de présentation',
                'details' => 'Présentation du nouveau produit à notre client',
                'status' => 'planned',
                'approval_status' => 'pending',
                'created_by' => $employee->id
            ],
            [
                'client_id' => $clients->id,
                'scheduled_at' => Carbon::now()->addDays(2)->setTime(14, 30),
                'subject' => 'Négociation contrat',
                'details' => 'Discussion des termes du nouveau contrat',
                'status' => 'planned',
                'approval_status' => 'pending',
                'created_by' => $employee->id
            ],
            [
                'client_id' => $clients->id,
                'scheduled_at' => Carbon::now()->addDays(3)->setTime(10, 0),
                'subject' => 'Suivi projet',
                'details' => 'Point sur l\'avancement du projet en cours',
                'status' => 'planned',
                'approval_status' => 'pending',
                'created_by' => $employee->id
            ]
        ];

        foreach ($appointments as $appointmentData) {
            Appointment::create($appointmentData);
        }
    }
}