# 🚀 CRM-Bh Connect - Guide de Déploiement

## 📋 Prérequis

- Compte GitHub avec le code du CRM
- Compte sur une plateforme de déploiement (Railway, Render, ou Heroku)
- Accès en ligne

## 🎯 Déploiement Rapide avec Railway

### 1. **Préparer le repository**
```bash
# Vérifier que tous les fichiers sont présents
ls -la
# Doit contenir : railway.json, nixpacks.toml, composer.json, package.json
```

### 2. **Pousser sur GitHub**
```bash
git add .
git commit -m "Ready for deployment"
git push origin main
```

### 3. **Déployer sur Railway**
1. Aller sur [https://railway.app](https://railway.app)
2. Se connecter avec GitHub
3. "New Project" → "Deploy from GitHub repo"
4. Sélectionner votre repository
5. Ajouter une base de données PostgreSQL
6. Configurer les variables d'environnement

### 4. **Variables d'environnement requises**
```env
APP_NAME=CRM-Bh Connect
APP_ENV=production
APP_DEBUG=false
LOG_LEVEL=error
APP_KEY=base64:dASoWc1LFXmpeH2g2uz7w/bcZurHwr5l3Uwvl4khPOY=
```

### 5. **Exécuter les migrations**
Dans les logs Railway :
```bash
php artisan migrate --force
php artisan db:seed --force
```

## 🎯 Déploiement avec Render

### 1. **Configuration du service**
- **Build Command:** `composer install --optimize-autoloader --no-dev && npm install && npm run build`
- **Start Command:** `php artisan serve --host=0.0.0.0 --port=$PORT`

### 2. **Base de données**
- Créer un service PostgreSQL
- Connecter avec la variable `DATABASE_URL`

## 🎯 Déploiement avec Heroku

### 1. **Préparer l'application**
```bash
heroku create crm-bhconnect
heroku addons:create heroku-postgresql:mini
```

### 2. **Configurer les variables**
```bash
heroku config:set APP_NAME="CRM-Bh Connect"
heroku config:set APP_ENV=production
heroku config:set APP_DEBUG=false
```

### 3. **Déployer**
```bash
git push heroku main
heroku run php artisan migrate --force
heroku run php artisan db:seed --force
```

## ✅ Vérifications post-déploiement

1. **L'application se charge** ✅
2. **Page de connexion fonctionne** ✅
3. **Base de données connectée** ✅
4. **Objectifs de performance visibles** ✅
5. **Import/Export CSV fonctionne** ✅

## 🔧 Dépannage

### Erreur 500
- Vérifier que `APP_KEY` est configuré
- Vérifier les logs de l'application

### Base de données
- Vérifier les variables d'environnement DB_*
- Vérifier que la base de données est active

### Assets non chargés
- Vérifier que `npm run build` a été exécuté
- Vérifier les permissions du dossier `public`

## 📞 Support

- Consulter les logs de la plateforme
- Vérifier la documentation de la plateforme choisie
- Tester en local avant de déployer des changements

---

**🎉 Votre CRM-Bh Connect est maintenant en ligne !**
