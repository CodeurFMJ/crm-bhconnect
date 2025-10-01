#!/bin/bash

echo "🚀 Démarrage de l'application CRM BhConnect..."

# Vérifier les variables d'environnement
echo "📋 Variables d'environnement:"
echo "PORT: $PORT"
echo "APP_ENV: $APP_ENV"

# Utiliser le port Railway ou 8080 par défaut
if [ -z "$PORT" ]; then
    PORT=8080
    echo "⚠️ PORT non défini, utilisation du port 8080"
else
    echo "✅ Port Railway détecté: $PORT"
fi

# Démarrer l'application
echo "🌐 Démarrage du serveur sur le port $PORT..."
php -S 0.0.0.0:$PORT
