#!/bin/bash

# Script de démarrage pour Railway
echo "🚀 Démarrage de CRM-Bh Connect..."

# Attendre que la base de données soit prête
echo "⏳ Attente de la base de données..."
sleep 10

# Exécuter les migrations si nécessaire
echo "🗄️ Exécution des migrations..."
php artisan migrate --force

# Seeder les données si nécessaire
echo "🌱 Seeding des données..."
php artisan db:seed --force

# Optimiser l'application
echo "⚡ Optimisation de l'application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Démarrer l'application
echo "🌐 Démarrage du serveur sur le port $PORT..."
php artisan serve --host=0.0.0.0 --port=$PORT
