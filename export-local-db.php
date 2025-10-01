<?php
// Script d'export de la base de données locale pour Supabase

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// Charger l'application Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "🗄️ Export de la base de données locale...\n";

try {
    // Vérifier la connexion à la base de données
    DB::connection()->getPdo();
    echo "✅ Connexion à la base de données réussie\n";
    
    // Obtenir toutes les tables
    $tables = DB::select("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'");
    
    $export = "-- Export de la base de données CRM BhConnect\n";
    $export .= "-- Généré le " . date('Y-m-d H:i:s') . "\n\n";
    
    foreach ($tables as $table) {
        $tableName = $table->table_name;
        
        // Ignorer les tables système
        if (in_array($tableName, ['migrations', 'failed_jobs', 'personal_access_tokens'])) {
            continue;
        }
        
        echo "📋 Export de la table: $tableName\n";
        
        // Obtenir les données de la table
        $data = DB::table($tableName)->get();
        
        if ($data->count() > 0) {
            $export .= "-- Données de la table $tableName\n";
            
            // Obtenir les colonnes
            $columns = array_keys($data->first()->toArray());
            $columnList = implode(', ', $columns);
            
            foreach ($data as $row) {
                $values = [];
                foreach ($columns as $column) {
                    $value = $row->$column;
                    if (is_null($value)) {
                        $values[] = 'NULL';
                    } else {
                        $values[] = "'" . addslashes($value) . "'";
                    }
                }
                $valueList = implode(', ', $values);
                $export .= "INSERT INTO $tableName ($columnList) VALUES ($valueList);\n";
            }
            $export .= "\n";
        }
    }
    
    // Sauvegarder l'export
    file_put_contents('database-export.sql', $export);
    echo "✅ Export sauvegardé dans database-export.sql\n";
    echo "📊 " . count($tables) . " tables exportées\n";
    
} catch (Exception $e) {
    echo "❌ Erreur lors de l'export: " . $e->getMessage() . "\n";
    exit(1);
}

echo "🎉 Export terminé avec succès !\n";
echo "📁 Fichier: database-export.sql\n";
echo "🚀 Vous pouvez maintenant importer ce fichier dans Supabase\n";
