#!/bin/bash

# Script de déploiement pour CRM-Bh Connect
echo "🚀 Démarrage du déploiement de CRM-Bh Connect..."

# Vérifier que nous sommes dans le bon répertoire
if [ ! -f "artisan" ]; then
    echo "❌ Erreur: Ce script doit être exécuté depuis la racine du projet Laravel"
    exit 1
fi

# 1. Installer les dépendances
echo "📦 Installation des dépendances..."
composer install --optimize-autoloader --no-dev

# 2. Compiler les assets
echo "🎨 Compilation des assets..."
npm install
npm run build

# 3. Générer la clé d'application si elle n'existe pas
if [ -z "$APP_KEY" ]; then
    echo "🔑 Génération de la clé d'application..."
    php artisan key:generate --force
fi

# 4. Optimiser l'application
echo "⚡ Optimisation de l'application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 5. Exécuter les migrations
echo "🗄️ Exécution des migrations..."
php artisan migrate --force

# 6. Seeder les données
echo "🌱 Seeding des données..."
php artisan db:seed --force

# 7. Nettoyer le cache
echo "🧹 Nettoyage du cache..."
php artisan cache:clear

echo "✅ Déploiement terminé avec succès!"
echo "🌐 Votre application est prête à être déployée"
