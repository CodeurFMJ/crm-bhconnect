# 🚀 Guide de Déploiement Railway + Supabase

## 📋 **Prérequis**

- ✅ Compte Railway : [railway.app](https://railway.app)
- ✅ Compte Supabase : [supabase.com](https://supabase.com)
- ✅ Repository GitHub configuré

## 🎯 **Étape 1 : Configuration Supabase**

### **1.1 Créer un projet Supabase**
1. Allez sur [supabase.com](https://supabase.com)
2. Cliquez sur "New Project"
3. Choisissez votre organisation
4. Nommez votre projet : `crm-bhconnect`
5. Créez un mot de passe fort pour la base de données
6. Choisissez une région proche de vous
7. Cliquez sur "Create new project"

### **1.2 Récupérer les informations de connexion**
1. Dans votre projet Supabase, allez dans **Settings** > **Database**
2. Copiez les informations suivantes :
   - **Host** : `db.xxxxxxxxxxxxx.supabase.co`
   - **Port** : `5432`
   - **Database** : `postgres`
   - **Username** : `postgres`
   - **Password** : `votre_mot_de_passe`

## 🚀 **Étape 2 : Déploiement sur Railway**

### **2.1 Créer un nouveau projet Railway**
1. Allez sur [railway.app](https://railway.app)
2. Cliquez sur "New Project"
3. Sélectionnez "Deploy from GitHub repo"
4. Choisissez votre repository `crm-bhconnect`
5. Cliquez sur "Deploy"

### **2.2 Configurer les variables d'environnement**
1. Dans votre projet Railway, allez dans **Variables**
2. Ajoutez les variables suivantes :

```bash
# Application
APP_NAME=CRM BhConnect
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app.railway.app

# Base de données Supabase
DB_CONNECTION=pgsql
DB_HOST=db.xxxxxxxxxxxxx.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=votre_mot_de_passe_supabase

# Clé d'application Laravel
APP_KEY=base64:VOTRE_CLE_APP_KEY_ICI
```

### **2.3 Générer la clé d'application**
```bash
# En local, générez une clé
php artisan key:generate --show

# Copiez la clé générée dans les variables Railway
```

## ⚙️ **Étape 3 : Configuration de la base de données**

### **3.1 Exécuter les migrations**
1. Dans Railway, allez dans **Deployments**
2. Cliquez sur votre déploiement
3. Ouvrez la console
4. Exécutez les commandes :

```bash
# Migrations
php artisan migrate --force

# Seeders
php artisan db:seed --force

# Cache
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🔧 **Étape 4 : Configuration Supabase (Optionnel)**

### **4.1 Activer l'authentification**
1. Dans Supabase, allez dans **Authentication** > **Settings**
2. Activez l'authentification par email
3. Configurez les URLs autorisées :
   - `https://your-app.railway.app`
   - `https://your-app.railway.app/login`
   - `https://your-app.railway.app/register`

### **4.2 Configurer les politiques de sécurité**
1. Allez dans **Authentication** > **Policies**
2. Créez des politiques pour vos tables
3. Exemple pour la table `users` :

```sql
-- Politique pour les utilisateurs
CREATE POLICY "Users can view own profile" ON users
    FOR SELECT USING (auth.uid() = id);

CREATE POLICY "Users can update own profile" ON users
    FOR UPDATE USING (auth.uid() = id);
```

## 🎉 **Étape 5 : Test du déploiement**

### **5.1 Vérifier l'application**
1. Ouvrez l'URL de votre application Railway
2. Testez la connexion : `/login`
3. Vérifiez les fonctionnalités :
   - ✅ Connexion utilisateur
   - ✅ Gestion des clients
   - ✅ Rendez-vous
   - ✅ Objectifs de performance
   - ✅ Import/Export CSV

### **5.2 Vérifier la base de données**
1. Dans Supabase, allez dans **Table Editor**
2. Vérifiez que les tables sont créées :
   - `users`
   - `clients`
   - `appointments`
   - `tasks`
   - `performance_objectives`
   - etc.

## 🚨 **Dépannage**

### **Problème : Erreur 500**
- Vérifiez les variables d'environnement
- Vérifiez les logs Railway
- Vérifiez la connexion à la base de données

### **Problème : Base de données non accessible**
- Vérifiez les informations de connexion Supabase
- Vérifiez que le projet Supabase est actif
- Vérifiez les politiques de sécurité

### **Problème : Migrations échouent**
- Vérifiez que la base de données est accessible
- Vérifiez les permissions de l'utilisateur
- Exécutez les migrations manuellement

## 📊 **Avantages de cette configuration**

- ✅ **Railway** : Déploiement simple et fiable
- ✅ **Supabase** : Base de données PostgreSQL gérée
- ✅ **Gratuit** : Plans gratuits généreux
- ✅ **Scalable** : Peut grandir avec vos besoins
- ✅ **Sécurisé** : HTTPS automatique
- ✅ **Monitoring** : Logs et métriques inclus

## 🎯 **Prochaines étapes**

1. **Testez** toutes les fonctionnalités
2. **Configurez** un domaine personnalisé (optionnel)
3. **Activez** les sauvegardes automatiques
4. **Configurez** le monitoring
5. **Déployez** en production

---

**🎉 Félicitations ! Votre CRM BhConnect est maintenant déployé sur Railway avec Supabase !**
