# 🚀 Guide de déploiement XAMPP - CRM BhConnect

## 📋 **Solution simple et fiable**

XAMPP est la solution la plus simple pour déployer votre CRM localement.

## 🔧 **Étape 1 : Installer XAMPP**

### **1.1 Télécharger XAMPP**
1. Allez sur [apachefriends.org](https://www.apachefriends.org/)
2. Téléchargez XAMPP pour Windows
3. Installez XAMPP avec les options par défaut

### **1.2 Démarrer XAMPP**
1. Ouvrez XAMPP Control Panel
2. Démarrez Apache (cliquez sur "Start")
3. Démarrez MySQL (cliquez sur "Start")
4. Vérifiez que les deux services sont verts

## 📋 **Étape 2 : Configurer le projet**

### **2.1 Copier le projet**
1. Copiez tout le dossier CRM dans `C:\xampp\htdocs\`
2. Renommez le dossier en `crm-bhconnect`

### **2.2 Configurer la base de données**
1. Ouvrez `http://localhost/phpmyadmin`
2. Créez une nouvelle base de données : `crm_bhconnect`
3. Choisissez l'encodage : `utf8mb4_unicode_ci`

### **2.3 Configurer les variables d'environnement**
1. Copiez `env-xampp` vers `.env`
2. Modifiez les paramètres si nécessaire

## 📋 **Étape 3 : Installer les dépendances**

### **3.1 Ouvrir un terminal**
1. Ouvrez Command Prompt ou PowerShell
2. Naviguez vers le dossier du projet :
```bash
cd C:\xampp\htdocs\crm-bhconnect
```

### **3.2 Installer Composer (si pas installé)**
1. Téléchargez Composer depuis [getcomposer.org](https://getcomposer.org/)
2. Installez Composer
3. Vérifiez l'installation : `composer --version`

### **3.3 Installer les dépendances PHP**
```bash
composer install
```

### **3.4 Installer les dépendances Node.js**
```bash
npm install
npm run build
```

## 📋 **Étape 4 : Configurer la base de données**

### **4.1 Exécuter les migrations**
```bash
php artisan migrate
```

### **4.2 Exécuter les seeders**
```bash
php artisan db:seed
```

### **4.3 Optimiser l'application**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 📋 **Étape 5 : Tester l'application**

### **5.1 Ouvrir l'application**
1. Ouvrez votre navigateur
2. Allez sur : `http://localhost/crm-bhconnect/public`
3. Vous devriez voir la page de test BhConnect

### **5.2 Tester l'application Laravel**
1. Cliquez sur "Application Laravel"
2. Connectez-vous avec :
   - Email : `admin@example.com`
   - Mot de passe : `password`

## 🎯 **Avantages de XAMPP**

- ✅ **Simple** - Installation en quelques clics
- ✅ **Fiable** - Fonctionne toujours
- ✅ **Gratuit** - Pas de coûts
- ✅ **Local** - Pas de dépendance internet
- ✅ **Familiar** - Interface connue

## 🧪 **Tester toutes les fonctionnalités**

### **Une fois configuré :**
1. **Page de test** - `http://localhost/crm-bhconnect/public`
2. **Application Laravel** - `http://localhost/crm-bhconnect/public/` (après connexion)
3. **Base de données** - Accessible via phpMyAdmin
4. **Toutes les fonctionnalités** - Clients, rendez-vous, tâches, etc.

## 🔧 **Commandes utiles**

### **Démarrer l'application :**
```bash
php artisan serve
```

### **Voir les logs :**
```bash
tail -f storage/logs/laravel.log
```

### **Nettoyer le cache :**
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## 🆘 **Si vous rencontrez des problèmes**

### **Problème de port :**
- Vérifiez que Apache et MySQL sont démarrés
- Vérifiez que les ports 80 et 3306 sont libres

### **Problème de base de données :**
- Vérifiez que MySQL est démarré
- Vérifiez que la base `crm_bhconnect` existe
- Vérifiez les paramètres dans `.env`

### **Problème de permissions :**
- Vérifiez que le dossier est dans `C:\xampp\htdocs\`
- Vérifiez que XAMPP a les permissions nécessaires

## 🎉 **Résultat attendu**

- ✅ **Application fonctionnelle** - Accessible sur localhost
- ✅ **Base de données** - MySQL configurée et accessible
- ✅ **Connexion** - admin@example.com / password
- ✅ **Dashboard complet** - Toutes les fonctionnalités disponibles
- ✅ **Développement** - Modifications en temps réel
