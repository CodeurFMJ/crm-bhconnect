# 🔧 Fix du problème de port - Railway

## ❌ Problème
```
Invalid address: 0.0.0.0:$PORT
```
La variable `$PORT` n'est pas accessible ou n'est pas définie.

## ✅ Solutions disponibles

### Solution 1 : Port fixe (Recommandée)
1. Renommez `railway-8080.json` en `railway.json`
2. Déployez l'application
3. Railway utilisera automatiquement le port 8080

### Solution 2 : Script de démarrage
1. Renommez `railway-script.json` en `railway.json`
2. Déployez l'application
3. Le script gérera le port automatiquement

### Solution 3 : Configuration actuelle
1. Utilisez `railway.json` actuel
2. Déployez l'application
3. Railway utilisera le port 8080

## 🚀 Instructions de déploiement

### Étape 1 : Supprimer l'ancien projet
1. Allez sur [railway.app](https://railway.app)
2. Supprimez complètement le projet qui ne fonctionne pas
3. Créez un nouveau projet

### Étape 2 : Déployer avec le port fixe
1. Cliquez sur "New Project"
2. Sélectionnez "Deploy from GitHub repo"
3. Choisissez `CodeurFMJ/crm-bhconnect`
4. **IMPORTANT** : Renommez `railway-8080.json` en `railway.json`
5. Cliquez sur "Deploy Now"

### Étape 3 : Tester l'application
1. Attendez que le déploiement soit terminé
2. Cliquez sur le domaine généré
3. Vous devriez voir la page de test BhConnect

## 📋 Variables d'environnement
```bash
APP_NAME=CRM BhConnect
APP_ENV=production
APP_DEBUG=false
APP_URL=https://votre-domaine.railway.app
```

## 🔍 Vérification du succès
- ✅ Page de test accessible
- ✅ Logo BhConnect affiché
- ✅ Thème orange/bleu appliqué
- ✅ Informations du serveur visibles
- ✅ Port affiché correctement

## 🆘 Si ça ne fonctionne toujours pas
1. Vérifiez les logs Railway
2. Assurez-vous que `railway-8080.json` est renommé en `railway.json`
3. Vérifiez que le port est correct
4. Contactez le support Railway

## 📝 Prochaines étapes
Une fois que la page de test fonctionne :
1. Configurer la base de données
2. Restaurer l'application Laravel complète
3. Tester toutes les fonctionnalités
4. Configurer un domaine personnalisé
