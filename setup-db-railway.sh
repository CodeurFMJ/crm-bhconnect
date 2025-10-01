#!/bin/bash

echo "🗄️ Configuration automatique de la base de données..."

# Vérifier si DATABASE_URL est définie
if [ -z "$DATABASE_URL" ]; then
    echo "❌ DATABASE_URL non définie"
    echo "📋 Veuillez ajouter DATABASE_URL dans Railway → Variables"
    echo "💡 Utilisez Supabase, PlanetScale ou Neon pour une base gratuite"
    exit 1
fi

echo "✅ DATABASE_URL détectée"

# Attendre que la base de données soit prête
echo "⏳ Attente de la base de données..."
sleep 10

# Exécuter les migrations
echo "⚙️ Exécution des migrations..."
php artisan migrate --force

# Exécuter les seeders
echo "🌱 Exécution des seeders..."
php artisan db:seed --force

# Optimiser l'application
echo "⚡ Optimisation de l'application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Base de données configurée avec succès !"
echo "🔑 Compte administrateur créé :"
echo "   Email: admin@example.com"
echo "   Mot de passe: password"
