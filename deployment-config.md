# Configuration de déploiement pour CRM-Bh Connect

## Variables d'environnement pour le déploiement

### Railway/Render/Heroku
```env
APP_NAME="CRM-Bh Connect"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://your-app-name.railway.app

LOG_CHANNEL=stack
LOG_LEVEL=error

# Base de données PostgreSQL (fournie par la plateforme)
DB_CONNECTION=pgsql
DB_HOST=your-db-host
DB_PORT=5432
DB_DATABASE=your-db-name
DB_USERNAME=your-db-user
DB_PASSWORD=your-db-password

# Cache et sessions
CACHE_DRIVER=file
SESSION_DRIVER=file
SESSION_LIFETIME=120

# Mail (optionnel)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@bhconnect.com"
MAIL_FROM_NAME="CRM-Bh Connect"
```

## Commandes de déploiement

### 1. Préparer l'application
```bash
# Générer la clé d'application
php artisan key:generate

# Installer les dépendances
composer install --optimize-autoloader --no-dev

# Compiler les assets
npm run build

# Exécuter les migrations
php artisan migrate --force

# Seeder les données
php artisan db:seed --force
```

### 2. Fichiers de configuration

#### railway.json (pour Railway)
```json
{
  "$schema": "https://railway.app/railway.schema.json",
  "build": {
    "builder": "NIXPACKS"
  },
  "deploy": {
    "startCommand": "php artisan serve --host=0.0.0.0 --port=$PORT",
    "healthcheckPath": "/",
    "healthcheckTimeout": 100,
    "restartPolicyType": "ON_FAILURE",
    "restartPolicyMaxRetries": 10
  }
}
```

#### Procfile (pour Heroku)
```
web: vendor/bin/heroku-php-apache2 public/
```

## Instructions de déploiement

### Option 1: Railway (Recommandé)

1. **Créer un compte Railway**
   - Aller sur https://railway.app
   - Se connecter avec GitHub

2. **Connecter le repository**
   - Cliquer sur "New Project"
   - Sélectionner "Deploy from GitHub repo"
   - Choisir votre repository CRM

3. **Ajouter une base de données**
   - Cliquer sur "New" → "Database" → "PostgreSQL"
   - Railway créera automatiquement les variables d'environnement

4. **Configurer les variables d'environnement**
   - Aller dans "Variables"
   - Ajouter les variables listées ci-dessus
   - Générer APP_KEY avec: `php artisan key:generate --show`

5. **Déployer**
   - Railway déploiera automatiquement
   - L'URL sera fournie après le déploiement

### Option 2: Render

1. **Créer un compte Render**
   - Aller sur https://render.com
   - Se connecter avec GitHub

2. **Créer un nouveau Web Service**
   - Connecter le repository
   - Choisir "Web Service"

3. **Configuration**
   - Build Command: `composer install --optimize-autoloader --no-dev && npm run build && php artisan migrate --force`
   - Start Command: `php artisan serve --host=0.0.0.0 --port=$PORT`

4. **Ajouter une base de données**
   - Créer un "PostgreSQL" service
   - Connecter au web service

### Option 3: Heroku

1. **Installer Heroku CLI**
   - Télécharger depuis https://devcenter.heroku.com/articles/heroku-cli

2. **Se connecter**
   ```bash
   heroku login
   ```

3. **Créer l'application**
   ```bash
   heroku create your-crm-bhconnect
   ```

4. **Ajouter PostgreSQL**
   ```bash
   heroku addons:create heroku-postgresql:mini
   ```

5. **Déployer**
   ```bash
   git add .
   git commit -m "Deploy to Heroku"
   git push heroku main
   ```

6. **Configurer**
   ```bash
   heroku run php artisan migrate --force
   heroku run php artisan db:seed --force
   ```

## Vérifications post-déploiement

1. **Tester l'application**
   - Vérifier que l'URL fonctionne
   - Tester la connexion à la base de données
   - Vérifier les fonctionnalités principales

2. **Configurer le domaine personnalisé** (optionnel)
   - Ajouter votre domaine dans les paramètres de la plateforme
   - Configurer les DNS

3. **Monitoring**
   - Surveiller les logs
   - Configurer les alertes si nécessaire

## Notes importantes

- **Railway** est recommandé pour sa simplicité
- **Render** offre plus d'heures gratuites
- **Heroku** a des limitations sur le plan gratuit
- Toujours tester en local avant de déployer
- Garder une copie de sauvegarde de la base de données
