# 🚀 CRM BhConnect - Déploiement Railway + Supabase

## 📋 **Description**

Ce repository contient la configuration de déploiement pour le CRM BhConnect sur Railway avec Supabase comme base de données.

## 🎯 **Fonctionnalités**

- ✅ **Gestion des clients** - CRUD complet
- ✅ **Rendez-vous** - Planification et suivi
- ✅ **Objectifs de performance** - Définis par l'administrateur
- ✅ **Import/Export CSV** - Données structurées
- ✅ **Thème BhConnect** - Interface personnalisée
- ✅ **Authentification** - Système de connexion sécurisé

## 🚀 **Déploiement rapide**

### **Prérequis**
- Compte Railway : [railway.app](https://railway.app)
- Compte Supabase : [supabase.com](https://supabase.com)
- Repository GitHub configuré

### **Étapes de déploiement**

1. **Créer le projet Supabase**
   - Allez sur [supabase.com](https://supabase.com)
   - Créez un nouveau projet `crm-bhconnect`
   - Récupérez les informations de connexion

2. **Déployer sur Railway**
   - Allez sur [railway.app](https://railway.app)
   - Connectez ce repository GitHub
   - Sélectionnez la branche `deployment-railway-supabase`
   - Configurez les variables d'environnement

3. **Configurer la base de données**
   - Exécutez les migrations : `php artisan migrate --force`
   - Exécutez les seeders : `php artisan db:seed --force`

## ⚙️ **Configuration**

### **Variables d'environnement requises**

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

### **Identifiants par défaut**

- **Email** : `admin@bhconnect.com`
- **Mot de passe** : `password`

## 📁 **Structure du projet**

```
├── app/                    # Code source Laravel
├── database/              # Migrations et seeders
├── public/                # Assets publics
├── resources/             # Vues et assets
├── routes/                # Routes de l'application
├── railway.json           # Configuration Railway
├── nixpacks.toml         # Configuration de build
├── start.sh              # Script de démarrage
├── env.example           # Variables d'environnement exemple
└── RAILWAY_SUPABASE_DEPLOYMENT.md  # Guide complet
```

## 🔧 **Développement local**

```bash
# Cloner le repository
git clone https://github.com/CodeurFMJ/crm-bhconnect-deployment.git
cd crm-bhconnect-deployment

# Installer les dépendances
composer install
npm install

# Configurer l'environnement
cp env.example .env
php artisan key:generate

# Configurer la base de données
# Modifiez .env avec vos informations Supabase

# Exécuter les migrations
php artisan migrate
php artisan db:seed

# Démarrer l'application
php artisan serve
```

## 📊 **Technologies utilisées**

- **Backend** : Laravel 10
- **Frontend** : Blade, Bootstrap 5
- **Base de données** : PostgreSQL (Supabase)
- **Déploiement** : Railway
- **CSS** : Thème BhConnect personnalisé

## 🎨 **Thème BhConnect**

- **Couleur principale** : Orange (#FF6B35)
- **Couleur secondaire** : Bleu foncé (#1B365D)
- **Logo** : BhConnect personnalisé
- **Interface** : Moderne et responsive

## 🚨 **Dépannage**

### **Problème : Erreur 500**
- Vérifiez les variables d'environnement
- Vérifiez les logs Railway
- Vérifiez la connexion à la base de données

### **Problème : Base de données non accessible**
- Vérifiez les informations de connexion Supabase
- Vérifiez que le projet Supabase est actif
- Vérifiez les politiques de sécurité

## 📞 **Support**

Pour toute question ou problème :
- Consultez le guide complet : `RAILWAY_SUPABASE_DEPLOYMENT.md`
- Vérifiez les logs de déploiement
- Contactez l'équipe de développement

## 📄 **Licence**

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

---

**🎉 Déployez votre CRM BhConnect en quelques minutes !**
