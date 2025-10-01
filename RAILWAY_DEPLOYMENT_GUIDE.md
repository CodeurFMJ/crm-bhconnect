# 🚀 Guide de Déploiement Railway - CRM BhConnect

## 📋 Prérequis
- Compte GitHub avec le repository `crm-bhconnect`
- Compte Railway (gratuit)
- Accès à la ligne de commande

## 🔧 Étape 1 : Préparer le Repository

### 1.1 Vérifier les fichiers de configuration
Assurez-vous que ces fichiers existent dans votre repository :
- ✅ `railway.json` (configuration simplifiée)
- ✅ `nixpacks.toml` (build configuration)
- ✅ `composer.json` (dépendances PHP)
- ✅ `package.json` (dépendances Node.js)

### 1.2 Pousser les changements
```bash
git add .
git commit -m "Configuration Railway simplifiée"
git push origin main
```

## 🌐 Étape 2 : Créer le Projet Railway

### 2.1 Aller sur Railway
1. Ouvrez [railway.app](https://railway.app)
2. Connectez-vous avec GitHub
3. Cliquez sur "New Project"

### 2.2 Connecter le Repository
1. Sélectionnez "Deploy from GitHub repo"
2. Choisissez `CodeurFMJ/crm-bhconnect`
3. Cliquez sur "Deploy Now"

## 🗄️ Étape 3 : Configurer la Base de Données

### 3.1 Ajouter PostgreSQL
1. Dans votre projet Railway
2. Cliquez sur "+ New"
3. Sélectionnez "Database" → "PostgreSQL"
4. Attendez que la base soit créée

### 3.2 Récupérer les informations de connexion
1. Cliquez sur la base de données PostgreSQL
2. Allez dans l'onglet "Variables"
3. Copiez la valeur de `DATABASE_URL`

## ⚙️ Étape 4 : Configurer les Variables d'Environnement

### 4.1 Aller dans les Variables
1. Cliquez sur votre service principal (l'application)
2. Allez dans l'onglet "Variables"
3. Ajoutez ces variables :

### 4.2 Variables essentielles
```bash
APP_NAME=CRM BhConnect
APP_ENV=production
APP_DEBUG=false
APP_URL=https://votre-domaine.railway.app
DATABASE_URL=postgresql://user:password@host:port/database
```

### 4.3 Générer la clé d'application
```bash
# En local, générez une clé :
php artisan key:generate --show
# Copiez la clé générée dans APP_KEY
```

## 🚀 Étape 5 : Déployer

### 5.1 Déclencher le déploiement
1. Railway va automatiquement détecter les changements
2. Le build va commencer
3. Attendez la fin du build (2-3 minutes)

### 5.2 Vérifier le déploiement
1. Allez dans l'onglet "Deployments"
2. Cliquez sur le domaine généré
3. Votre application devrait être accessible

## 🔍 Étape 6 : Résoudre les Problèmes

### 6.1 Si le build échoue
- Vérifiez les logs dans Railway
- Assurez-vous que toutes les variables sont définies
- Vérifiez que `APP_KEY` est bien généré

### 6.2 Si l'application ne démarre pas
- Vérifiez que `DATABASE_URL` est correct
- Assurez-vous que `APP_URL` correspond au domaine Railway
- Vérifiez les logs d'erreur

### 6.3 Si la base de données n'est pas accessible
- Vérifiez que PostgreSQL est bien déployé
- Vérifiez que `DATABASE_URL` est correct
- Attendez quelques minutes que la base soit prête

## 📊 Étape 7 : Vérifier le Fonctionnement

### 7.1 Tester l'application
1. Ouvrez l'URL de votre application
2. Vous devriez voir la page de connexion
3. Testez la création d'un compte admin

### 7.2 Vérifier la base de données
1. Allez dans Railway → PostgreSQL → Query
2. Exécutez : `SELECT * FROM users;`
3. Vous devriez voir les utilisateurs créés

## 🎉 Félicitations !

Votre CRM BhConnect est maintenant déployé sur Railway !

### 📝 Prochaines étapes
- Configurer un domaine personnalisé (optionnel)
- Configurer l'envoi d'emails
- Sauvegarder régulièrement la base de données
- Surveiller les performances

## 🆘 Support

Si vous rencontrez des problèmes :
1. Vérifiez les logs Railway
2. Consultez la documentation Railway
3. Vérifiez que toutes les variables sont correctes
