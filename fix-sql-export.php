<?php
// Script pour corriger l'export SQL avec les bons noms de colonnes

require_once 'vendor/autoload.php';

// Charger l'application Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "🔧 Correction de l'export SQL...\n";

try {
    // Obtenir les vrais noms de colonnes
    $task = App\Models\Task::first();
    $user = App\Models\User::first();
    $client = App\Models\Client::first();
    $appointment = App\Models\Appointment::first();
    
    if ($task) {
        echo "📋 Colonnes de la table tasks:\n";
        foreach ($task->getAttributes() as $key => $value) {
            echo "  - $key\n";
        }
    }
    
    if ($user) {
        echo "👥 Colonnes de la table users:\n";
        foreach ($user->getAttributes() as $key => $value) {
            echo "  - $key\n";
        }
    }
    
    if ($client) {
        echo "🏢 Colonnes de la table clients:\n";
        foreach ($client->getAttributes() as $key => $value) {
            echo "  - $key\n";
        }
    }
    
    if ($appointment) {
        echo "📅 Colonnes de la table appointments:\n";
        foreach ($appointment->getAttributes() as $key => $value) {
            echo "  - $key\n";
        }
    }
    
    // Créer le fichier SQL corrigé
    $sql = "-- Export corrigé des données CRM BhConnect pour Supabase\n";
    $sql .= "-- Généré le " . date('Y-m-d H:i:s') . "\n\n";
    
    // Exporter les utilisateurs
    $users = App\Models\User::all();
    if ($users->count() > 0) {
        $sql .= "-- Utilisateurs\n";
        foreach ($users as $user) {
            $sql .= "INSERT INTO users (id, name, email, email_verified_at, password, role, remember_token, created_at, updated_at) VALUES ";
            $sql .= "(" . $user->id . ", ";
            $sql .= "'" . addslashes($user->name) . "', ";
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
            $sql .= "INSERT INTO clients (id, name, email, phone, address, company, created_at, updated_at) VALUES ";
            $sql .= "(" . $client->id . ", ";
            $sql .= "'" . addslashes($client->name) . "', ";
            $sql .= "'" . addslashes($client->email) . "', ";
            $sql .= "'" . addslashes($client->phone) . "', ";
            $sql .= "'" . addslashes($client->address) . "', ";
            $sql .= "'" . addslashes($client->company) . "', ";
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
            $sql .= "INSERT INTO appointments (id, client_id, title, description, appointment_date, status, created_by, created_at, updated_at) VALUES ";
            $sql .= "(" . $appointment->id . ", ";
            $sql .= $appointment->client_id . ", ";
            $sql .= "'" . addslashes($appointment->title) . "', ";
            $sql .= "'" . addslashes($appointment->description) . "', ";
            $sql .= "'" . $appointment->appointment_date . "', ";
            $sql .= "'" . addslashes($appointment->status) . "', ";
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
            $sql .= "'" . addslashes($task->title) . "', ";
            $sql .= "'" . addslashes($task->description) . "', ";
            $sql .= "'" . addslashes($task->status) . "', ";
            $sql .= "'" . addslashes($task->priority) . "', ";
            $sql .= "'" . $task->due_date . "', ";
            $sql .= $task->assigned_to . ", ";
            $sql .= $task->created_by . ", ";
            $sql .= "'" . $task->created_at . "', ";
            $sql .= "'" . $task->updated_at . "');\n";
        }
        $sql .= "\n";
    }
    
    // Sauvegarder le fichier corrigé
    file_put_contents('supabase-import-fixed.sql', $sql);
    
    echo "✅ Export corrigé terminé !\n";
    echo "📁 Fichier: supabase-import-fixed.sql\n";
    echo "📊 Données exportées:\n";
    echo "   - Utilisateurs: " . $users->count() . "\n";
    echo "   - Clients: " . $clients->count() . "\n";
    echo "   - Rendez-vous: " . $appointments->count() . "\n";
    echo "   - Tâches: " . $tasks->count() . "\n";
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    exit(1);
}
