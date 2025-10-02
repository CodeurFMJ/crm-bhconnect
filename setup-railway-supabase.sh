#!/bin/bash

echo "🚀 Configuration automatique Railway + Supabase"
echo "=============================================="

# Vérifier que nous sommes dans un projet Laravel
if [ ! -f "artisan" ]; then
    echo "❌ Erreur : Ce script doit être exécuté dans un projet Laravel"
    exit 1
fi

echo "✅ Projet Laravel détecté"

# Générer une clé d'application si elle n'existe pas
if [ -z "$APP_KEY" ]; then
    echo "🔑 Génération de la clé d'application..."
    php artisan key:generate --show
    echo "⚠️  Copiez cette clé et ajoutez-la aux variables d'environnement Railway"
fi

# Vérifier la configuration de la base de données
echo "🔍 Vérification de la configuration de la base de données..."
if [ -z "$DB_HOST" ]; then
    echo "⚠️  Variable DB_HOST non définie"
    echo "   Ajoutez les variables d'environnement Supabase dans Railway"
fi

if [ -z "$DB_PASSWORD" ]; then
    echo "⚠️  Variable DB_PASSWORD non définie"
    echo "   Ajoutez le mot de passe Supabase dans Railway"
fi

# Tester la connexion à la base de données
echo "🔌 Test de connexion à la base de données..."
if php artisan migrate:status > /dev/null 2>&1; then
    echo "✅ Connexion à la base de données réussie"
    
    # Exécuter les migrations
    echo "⚙️ Exécution des migrations..."
    php artisan migrate --force
    
    # Exécuter les seeders
    echo "🌱 Exécution des seeders..."
    php artisan db:seed --force
    
    echo "✅ Base de données configurée avec succès"
else
    echo "❌ Impossible de se connecter à la base de données"
    echo "   Vérifiez vos variables d'environnement Supabase"
fi

# Optimiser l'application
echo "⚡ Optimisation de l'application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "🎉 Configuration terminée !"
echo ""
echo "📋 Prochaines étapes :"
echo "1. Vérifiez que toutes les variables d'environnement sont définies"
echo "2. Testez l'application : php artisan serve"
echo "3. Déployez sur Railway"
echo ""
echo "📖 Consultez RAILWAY_SUPABASE_DEPLOYMENT.md pour plus de détails"
