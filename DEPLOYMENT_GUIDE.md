# 🚀 Guide de Déploiement - CRM-Bh Connect

## Options de déploiement gratuit

### 🥇 **Railway (Recommandé)**
- ✅ **500 heures gratuites/mois**
- ✅ **Base de données PostgreSQL incluse**
- ✅ **Déploiement automatique depuis GitHub**
- ✅ **SSL automatique**
- ✅ **Interface simple et intuitive**

### 🥈 **Render**
- ✅ **750 heures gratuites/mois**
- ✅ **Base de données PostgreSQL gratuite**
- ✅ **Déploiement automatique**
- ✅ **SSL inclus**

### 🥉 **Heroku**
- ⚠️ **Gratuit mais avec limitations**
- ✅ **Base de données PostgreSQL gratuite**
- ⚠️ **L'application s'endort après 30 min d'inactivité**

---

## 🎯 **Déploiement avec Railway (Recommandé)**

### **Étape 1: Préparation du code**

1. **Pousser votre code sur GitHub**
   ```bash
   git add .
   git commit -m "Prepare for deployment"
   git push origin main
   ```

2. **Vérifier que tous les fichiers sont présents**
   - ✅ `railway.json`
   - ✅ `nixpacks.toml`
   - ✅ `deploy.sh`
   - ✅ `composer.json`
   - ✅ `package.json`

### **Étape 2: Créer un compte Railway**

1. Aller sur [https://railway.app](https://railway.app)
2. Cliquer sur "Login" et se connecter avec GitHub
3. Autoriser Railway à accéder à vos repositories

### **Étape 3: Déployer l'application**

1. **Créer un nouveau projet**
   - Cliquer sur "New Project"
   - Sélectionner "Deploy from GitHub repo"
   - Choisir votre repository "CRM"

2. **Ajouter une base de données**
   - Cliquer sur "New" dans le dashboard
   - Sélectionner "Database" → "PostgreSQL"
   - Railway créera automatiquement les variables d'environnement

3. **Configurer les variables d'environnement**
   - Aller dans l'onglet "Variables" de votre service
   - Ajouter les variables suivantes :

   ```env
   APP_NAME=CRM-Bh Connect
   APP_ENV=production
   APP_DEBUG=false
   LOG_LEVEL=error
   ```

   **Note:** Railway ajoutera automatiquement les variables de base de données.

4. **Générer la clé d'application**
   - Dans l'onglet "Deployments", cliquer sur "View Logs"
   - Exécuter la commande : `php artisan key:generate --show`
   - Copier la clé générée
   - L'ajouter dans les variables d'environnement comme `APP_KEY`

### **Étape 4: Exécuter les migrations**

1. **Aller dans l'onglet "Deployments"**
2. **Cliquer sur "View Logs"**
3. **Exécuter les commandes suivantes :**

   ```bash
   php artisan migrate --force
   php artisan db:seed --force
   ```

### **Étape 5: Tester l'application**

1. **Obtenir l'URL de votre application**
   - Railway fournira une URL comme : `https://your-app-name.railway.app`

2. **Tester les fonctionnalités**
   - ✅ Page de connexion
   - ✅ Tableau de bord
   - ✅ Gestion des clients
   - ✅ Objectifs de performance
   - ✅ Import/Export CSV

---

## 🎯 **Déploiement avec Render**

### **Étape 1: Créer un compte Render**

1. Aller sur [https://render.com](https://render.com)
2. Se connecter avec GitHub

### **Étape 2: Créer un Web Service**

1. **Nouveau Web Service**
   - Cliquer sur "New" → "Web Service"
   - Connecter votre repository GitHub
   - Choisir la branche "main"

2. **Configuration du service**
   ```
   Name: crm-bhconnect
   Environment: PHP
   Region: Oregon (US West)
   Branch: main
   Root Directory: (laisser vide)
   Build Command: composer install --optimize-autoloader --no-dev && npm install && npm run build
   Start Command: php artisan serve --host=0.0.0.0 --port=$PORT
   ```

### **Étape 3: Ajouter une base de données**

1. **Créer une base de données PostgreSQL**
   - Cliquer sur "New" → "PostgreSQL"
   - Nommer la base : `crm-bhconnect-db`
   - Choisir le plan gratuit

2. **Connecter la base au service**
   - Dans les paramètres du Web Service
   - Ajouter la variable d'environnement `DATABASE_URL`
   - Copier l'URL de connexion depuis la base de données

### **Étape 4: Configurer les variables d'environnement**

```env
APP_NAME=CRM-Bh Connect
APP_ENV=production
APP_DEBUG=false
LOG_LEVEL=error
```

### **Étape 5: Déployer et tester**

1. **Déployer**
   - Cliquer sur "Deploy"
   - Attendre que le build se termine

2. **Exécuter les migrations**
   - Dans l'onglet "Shell"
   - Exécuter : `php artisan migrate --force && php artisan db:seed --force`

---

## 🎯 **Déploiement avec Heroku**

### **Étape 1: Installer Heroku CLI**

1. Télécharger depuis [https://devcenter.heroku.com/articles/heroku-cli](https://devcenter.heroku.com/articles/heroku-cli)
2. Installer et redémarrer le terminal

### **Étape 2: Se connecter et créer l'application**

```bash
# Se connecter à Heroku
heroku login

# Créer l'application
heroku create crm-bhconnect

# Ajouter PostgreSQL
heroku addons:create heroku-postgresql:mini
```

### **Étape 3: Configurer les variables d'environnement**

```bash
# Configurer les variables
heroku config:set APP_NAME="CRM-Bh Connect"
heroku config:set APP_ENV=production
heroku config:set APP_DEBUG=false
heroku config:set LOG_LEVEL=error
```

### **Étape 4: Déployer**

```bash
# Pousser le code
git add .
git commit -m "Deploy to Heroku"
git push heroku main

# Exécuter les migrations
heroku run php artisan migrate --force
heroku run php artisan db:seed --force
```

---

## 🔧 **Configuration post-déploiement**

### **1. Vérifier la configuration**

- ✅ L'application se charge correctement
- ✅ La base de données est connectée
- ✅ Les migrations sont exécutées
- ✅ Les données de test sont présentes

### **2. Tester les fonctionnalités**

- ✅ Connexion utilisateur
- ✅ Tableau de bord
- ✅ Gestion des clients
- ✅ Objectifs de performance
- ✅ Import/Export CSV

### **3. Configurer un domaine personnalisé (optionnel)**

1. **Railway**
   - Aller dans les paramètres du service
   - Ajouter votre domaine personnalisé
   - Configurer les DNS

2. **Render**
   - Aller dans les paramètres du service
   - Ajouter un domaine personnalisé
   - Suivre les instructions DNS

3. **Heroku**
   - Installer l'addon pour domaine personnalisé
   - Configurer les DNS

---

## 🚨 **Dépannage**

### **Problèmes courants**

1. **Erreur 500**
   - Vérifier les logs de l'application
   - Vérifier que `APP_KEY` est configuré
   - Vérifier les permissions des fichiers

2. **Base de données non connectée**
   - Vérifier les variables d'environnement de la DB
   - Vérifier que la base de données est active

3. **Assets non chargés**
   - Vérifier que `npm run build` a été exécuté
   - Vérifier les permissions du dossier `public`

4. **Migrations échouées**
   - Vérifier la connexion à la base de données
   - Exécuter `php artisan migrate:status`

### **Commandes utiles**

```bash
# Voir les logs
heroku logs --tail

# Accéder au shell
heroku run bash

# Redémarrer l'application
heroku restart

# Vider le cache
heroku run php artisan cache:clear
```

---

## 📊 **Monitoring et maintenance**

### **1. Surveiller les performances**
- Vérifier régulièrement les logs
- Surveiller l'utilisation des ressources
- Tester les fonctionnalités principales

### **2. Sauvegardes**
- Exporter régulièrement les données
- Utiliser les fonctionnalités d'import/export CSV
- Garder une copie locale du code

### **3. Mises à jour**
- Mettre à jour les dépendances régulièrement
- Tester les mises à jour en local avant déploiement
- Garder une documentation des changements

---

## 🎉 **Félicitations !**

Votre CRM-Bh Connect est maintenant déployé et accessible en ligne ! 

**Prochaines étapes :**
1. Tester toutes les fonctionnalités
2. Configurer un domaine personnalisé si nécessaire
3. Former les utilisateurs
4. Mettre en place un système de sauvegarde régulier

**Support :**
- Consulter les logs en cas de problème
- Vérifier la documentation de la plateforme choisie
- Tester en local avant de déployer des changements
