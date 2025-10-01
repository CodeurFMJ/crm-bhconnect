<?php
// Script pour créer un SQL parfaitement propre pour Supabase

require_once 'vendor/autoload.php';

// Charger l'application Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "🧹 Création d'un SQL propre pour Supabase...\n";

try {
    // Fonction pour nettoyer les chaînes
    function cleanString($str) {
        // Remplacer les apostrophes par des espaces
        $str = str_replace("'", " ", $str);
        // Remplacer les caractères spéciaux
        $str = str_replace(["à", "é", "è", "ê", "ë", "ç", "ù", "û", "ü", "ô", "ö", "î", "ï", "â", "ä"], 
                          ["a", "e", "e", "e", "e", "c", "u", "u", "u", "o", "o", "i", "i", "a", "a"], $str);
        // Supprimer les caractères non-ASCII
        $str = preg_replace('/[^\x20-\x7E]/', '', $str);
        return trim($str);
    }
    
    // Créer le fichier SQL propre
    $sql = "-- Import propre pour Supabase - CRM BhConnect\n";
    $sql .= "-- Généré le " . date('Y-m-d H:i:s') . "\n\n";
    
    // Exporter les utilisateurs
    $users = App\Models\User::all();
    if ($users->count() > 0) {
        $sql .= "-- Utilisateurs\n";
        foreach ($users as $user) {
            $sql .= "INSERT INTO users (id, name, email, email_verified_at, password, role, remember_token, created_at, updated_at) VALUES ";
            $sql .= "(" . $user->id . ", ";
            $sql .= "'" . addslashes(cleanString($user->name)) . "', ";
            $sql .= "'" . addslashes($user->email) . "', ";
            $sql .= ($user->email_verified_at ? "'" . $user->email_verified_at . "'" : "NULL") . ", ";
            $sql .= "'" . addslashes($user->password) . "', ";
            $sql .= "'" . addslashes($user->role) . "', ";
            $sql .= ($user->remember_token ? "'" . addslashes($user->remember_token) . "'" : "NULL") . ", ";
            $sql .= "'" . $user->created_at . "', ";
            $sql .= "'" . $user->updated_at . "');\n";
        }
        $sql .= "\n";
    }
    
    // Exporter les clients
    $clients = App\Models\Client::all();
    if ($clients->count() > 0) {
        $sql .= "-- Clients\n";
        foreach ($clients as $client) {
            $sql .= "INSERT INTO clients (id, first_name, last_name, age, revenue, assigned_user_id, status, created_at, updated_at) VALUES ";
            $sql .= "(" . $client->id . ", ";
            $sql .= "'" . addslashes(cleanString($client->first_name)) . "', ";
            $sql .= "'" . addslashes(cleanString($client->last_name)) . "', ";
            $sql .= ($client->age ? $client->age : "NULL") . ", ";
            $sql .= ($client->revenue ? $client->revenue : "NULL") . ", ";
            $sql .= ($client->assigned_user_id ? $client->assigned_user_id : "NULL") . ", ";
            $sql .= "'" . addslashes($client->status) . "', ";
            $sql .= "'" . $client->created_at . "', ";
            $sql .= "'" . $client->updated_at . "');\n";
        }
        $sql .= "\n";
    }
    
    // Exporter les rendez-vous
    $appointments = App\Models\Appointment::all();
    if ($appointments->count() > 0) {
        $sql .= "-- Rendez-vous\n";
        foreach ($appointments as $appointment) {
            $sql .= "INSERT INTO appointments (id, client_id, scheduled_at, subject, details, status, approval_status, created_by, created_at, updated_at) VALUES ";
            $sql .= "(" . $appointment->id . ", ";
            $sql .= $appointment->client_id . ", ";
            $sql .= "'" . $appointment->scheduled_at . "', ";
            $sql .= "'" . addslashes(cleanString($appointment->subject)) . "', ";
            $sql .= "'" . addslashes(cleanString($appointment->details)) . "', ";
            $sql .= "'" . addslashes($appointment->status) . "', ";
            $sql .= "'" . addslashes($appointment->approval_status) . "', ";
            $sql .= $appointment->created_by . ", ";
            $sql .= "'" . $appointment->created_at . "', ";
            $sql .= "'" . $appointment->updated_at . "');\n";
        }
        $sql .= "\n";
    }
    
    // Exporter les tâches
    $tasks = App\Models\Task::all();
    if ($tasks->count() > 0) {
        $sql .= "-- Tâches\n";
        foreach ($tasks as $task) {
            $sql .= "INSERT INTO tasks (id, title, description, status, priority, due_date, assigned_to, created_by, created_at, updated_at) VALUES ";
            $sql .= "(" . $task->id . ", ";
            $sql .= "'" . addslashes(cleanString($task->title)) . "', ";
            $sql .= "'" . addslashes(cleanString($task->description)) . "', ";
            $sql .= "'" . addslashes($task->status) . "', ";
            $sql .= "'" . addslashes($task->priority) . "', ";
            $sql .= "'" . $task->due_date . "', ";
            $sql .= ($task->assigned_to ? $task->assigned_to : "NULL") . ", ";
            $sql .= $task->created_by . ", ";
            $sql .= "'" . $task->created_at . "', ";
            $sql .= "'" . $task->updated_at . "');\n";
        }
        $sql .= "\n";
    }
    
    // Sauvegarder le fichier propre
    file_put_contents('supabase-clean.sql', $sql);
    
    echo "✅ SQL propre créé avec succès !\n";
    echo "📁 Fichier: supabase-clean.sql\n";
    echo "📊 Données exportées:\n";
    echo "   - Utilisateurs: " . $users->count() . "\n";
    echo "   - Clients: " . $clients->count() . "\n";
    echo "   - Rendez-vous: " . $appointments->count() . "\n";
    echo "   - Tâches: " . $tasks->count() . "\n";
    echo "🧹 Caractères spéciaux nettoyés\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    exit(1);
}
