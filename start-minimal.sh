#!/bin/bash

echo "🚀 Démarrage minimal de l'application CRM BhConnect..."

# Vérifier les variables d'environnement
echo "📋 Variables d'environnement:"
echo "PORT: $PORT"
echo "APP_ENV: $APP_ENV"

# Démarrer l'application sans base de données
echo "🌐 Démarrage du serveur sur le port $PORT..."
php artisan serve --host=0.0.0.0 --port=$PORT
