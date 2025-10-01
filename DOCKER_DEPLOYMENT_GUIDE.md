# 🐳 Guide de déploiement Docker - CRM BhConnect

## 🚀 **Déploiement avec Docker sur Railway**

### **Étape 1 : Supprimer l'ancien projet**
1. Allez sur [railway.app](https://railway.app)
2. Supprimez l'ancien projet qui ne fonctionne pas
3. Créez un nouveau projet

### **Étape 2 : Utiliser la configuration Docker**
1. Renommez `railway-docker.json` en `railway.json`
2. Déployez l'application
3. Railway va utiliser Docker pour construire et déployer

### **Étape 3 : Ajouter la base de données MySQL**
1. Cliquez sur "+ New"
2. Sélectionnez "Database"
3. Choisissez "MySQL"
4. Attendez que la base soit créée

### **Étape 4 : Configurer les variables d'environnement**
Ajoutez ces variables dans Railway :

```bash
APP_NAME=CRM BhConnect
APP_ENV=production
APP_DEBUG=false
APP_URL=https://votre-domaine.railway.app
APP_KEY=base64:PKGJbGg/WRENhBrcAHRWtvLOCzTszrtyfzGoh1j9xP8=
DATABASE_URL=mysql://root:[password]@[host]:[port]/[database]
```

## 🎯 **Avantages de Docker**

- ✅ **Environnement isolé** - Pas de conflits de dépendances
- ✅ **Configuration reproductible** - Fonctionne partout
- ✅ **Déploiement fiable** - Moins d'erreurs
- ✅ **Performance** - Optimisé pour la production
- ✅ **Scalabilité** - Facile à mettre à l'échelle

## 📊 **Ce que fait le Dockerfile**

1. **Installe PHP 8.1** avec toutes les extensions nécessaires
2. **Installe Node.js et npm** pour les assets
3. **Installe Composer** pour les dépendances PHP
4. **Copie l'application** dans le conteneur
5. **Installe les dépendances** PHP et Node.js
6. **Compile les assets** avec npm
7. **Démarre l'application** avec le script start.sh

## 🧪 **Tester l'application**

### **Une fois déployé :**
1. Ouvrez votre application Railway
2. Vous devriez voir la page de test BhConnect
3. Cliquez sur "Application Laravel"
4. Connectez-vous avec : admin@example.com / password

## 🔧 **Développement local avec Docker**

### **Démarrer l'application localement :**
```bash
# Construire et démarrer les conteneurs
docker-compose up --build

# Accéder à l'application
http://localhost:8080
```

### **Arrêter l'application :**
```bash
docker-compose down
```

## 🆘 **Si vous rencontrez des problèmes**

1. Vérifiez les logs Railway
2. Vérifiez que toutes les variables sont définies
3. Vérifiez que MySQL est créé
4. Redéployez manuellement si nécessaire

## 🎉 **Résultat attendu**

- ✅ **Application Docker** - Déployée et fonctionnelle
- ✅ **Base de données** - Configurée et accessible
- ✅ **Connexion** - admin@example.com / password
- ✅ **Dashboard complet** - Toutes les fonctionnalités disponibles
