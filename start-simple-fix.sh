#!/bin/bash

echo "🚀 Démarrage simple de l'application CRM BhConnect..."

# Vérifier les variables d'environnement
echo "📋 Variables d'environnement:"
echo "PORT: $PORT"
echo "APP_ENV: $APP_ENV"
echo "DATABASE_URL: ${DATABASE_URL:0:20}..."

# Attendre un peu que la base de données soit prête
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

# Démarrer l'application
echo "🌐 Démarrage du serveur sur le port $PORT..."
php artisan serve --host=0.0.0.0 --port=$PORT
