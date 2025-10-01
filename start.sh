#!/bin/bash

echo "🐳 Démarrage de l'application CRM BhConnect avec Docker..."

# Vérifier les variables d'environnement
echo "📋 Variables d'environnement:"
echo "PORT: $PORT"
echo "APP_ENV: $APP_ENV"
echo "DATABASE_URL: ${DATABASE_URL:0:20}..."

# Attendre que la base de données soit prête (si configurée)
if [ ! -z "$DATABASE_URL" ]; then
    echo "⏳ Attente de la base de données..."
    sleep 10
fi

# Exécuter les migrations (si base de données configurée)
if [ ! -z "$DATABASE_URL" ]; then
    echo "⚙️ Exécution des migrations..."
    php artisan migrate --force
    
    echo "🌱 Exécution des seeders..."
    php artisan db:seed --force
fi

# Optimiser l'application
echo "⚡ Optimisation de l'application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Démarrer l'application
echo "🌐 Démarrage du serveur sur le port $PORT..."
php artisan serve --host=0.0.0.0 --port=$PORT