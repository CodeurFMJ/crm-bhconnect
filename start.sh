#!/bin/bash

echo "🚀 Démarrage de l'application CRM BhConnect..."

# Attendre que la base de données soit prête
echo "⏳ Attente de la base de données Supabase..."
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

# Démarrer l'application
echo "🌐 Démarrage du serveur sur le port $PORT..."
php artisan serve --host=0.0.0.0 --port=$PORT
