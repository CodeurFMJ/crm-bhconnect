<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\LoginLog;
use Carbon\Carbon;

class LoginLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        
        if ($users->isEmpty()) {
            $this->command->info('Aucun utilisateur trouvé. Créez d\'abord des utilisateurs.');
            return;
        }

        foreach ($users as $user) {
            // Créer des logs pour les 7 derniers jours
            for ($i = 0; $i < 7; $i++) {
                $date = Carbon::now()->subDays($i);
                
                // Générer 1-3 sessions par jour
                $sessions = rand(1, 3);
                
                for ($j = 0; $j < $sessions; $j++) {
                    $loginTime = $date->copy()->addHours(rand(8, 18))->addMinutes(rand(0, 59));
                    $logoutTime = $loginTime->copy()->addHours(rand(1, 8))->addMinutes(rand(0, 59));
                    
                    // Login
                    LoginLog::create([
                        'user_id' => $user->id,
                        'action' => 'login',
                        'logged_at' => $loginTime,
                        'ip_address' => '192.168.1.' . rand(100, 200),
                        'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
                    ]);
                    
                    // Logout (sauf pour la dernière session d'aujourd'hui si c'est aujourd'hui)
                    if (!($i === 0 && $j === $sessions - 1)) {
                        LoginLog::create([
                            'user_id' => $user->id,
                            'action' => 'logout',
                            'logged_at' => $logoutTime,
                            'ip_address' => '192.168.1.' . rand(100, 200),
                            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
                        ]);
                    }
                }
            }
        }
        
        $this->command->info('Logs de connexion créés avec succès!');
    }
}