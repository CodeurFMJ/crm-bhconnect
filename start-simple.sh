#!/bin/bash

# Script de démarrage simple pour Railway
echo "🚀 Démarrage de l'application CRM BhConnect..."

# Vérifier les variables d'environnement
echo "📋 Variables d'environnement:"
echo "PORT: $PORT"
echo "DATABASE_URL: ${DATABASE_URL:0:20}..."

# Démarrer l'application directement
echo "🌐 Démarrage du serveur sur le port $PORT..."
php artisan serve --host=0.0.0.0 --port=$PORT
