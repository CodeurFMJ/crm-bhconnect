<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PerformanceObjective;

class PerformanceObjectiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $objectives = [
            [
                'name' => 'Chiffre d\'affaires mensuel',
                'type' => 'revenue',
                'target_value' => 5000000.00,
                'unit' => 'FCFA',
                'period' => 'monthly',
                'description' => 'Objectif de chiffre d\'affaires mensuel pour l\'ensemble de l\'équipe',
                'is_active' => true,
            ],
            [
                'name' => 'Nombre de nouveaux clients',
                'type' => 'clients',
                'target_value' => 50.00,
                'unit' => 'clients',
                'period' => 'monthly',
                'description' => 'Objectif de nouveaux clients acquis chaque mois',
                'is_active' => true,
            ],
            [
                'name' => 'Rendez-vous planifiés',
                'type' => 'appointments',
                'target_value' => 100.00,
                'unit' => 'RDV',
                'period' => 'monthly',
                'description' => 'Nombre de rendez-vous planifiés chaque mois',
                'is_active' => true,
            ],
            [
                'name' => 'Tâches complétées',
                'type' => 'tasks',
                'target_value' => 200.00,
                'unit' => 'tâches',
                'period' => 'monthly',
                'description' => 'Nombre de tâches complétées chaque mois',
                'is_active' => true,
            ],
            [
                'name' => 'Taux de conversion',
                'type' => 'conversion',
                'target_value' => 15.00,
                'unit' => '%',
                'period' => 'monthly',
                'description' => 'Taux de conversion des prospects en clients',
                'is_active' => true,
            ],
            [
                'name' => 'Chiffre d\'affaires trimestriel',
                'type' => 'revenue',
                'target_value' => 15000000.00,
                'unit' => 'FCFA',
                'period' => 'quarterly',
                'description' => 'Objectif de chiffre d\'affaires trimestriel',
                'is_active' => true,
            ],
            [
                'name' => 'Chiffre d\'affaires annuel',
                'type' => 'revenue',
                'target_value' => 60000000.00,
                'unit' => 'FCFA',
                'period' => 'yearly',
                'description' => 'Objectif de chiffre d\'affaires annuel',
                'is_active' => true,
            ],
        ];

        foreach ($objectives as $objective) {
            PerformanceObjective::create($objective);
        }
    }
}