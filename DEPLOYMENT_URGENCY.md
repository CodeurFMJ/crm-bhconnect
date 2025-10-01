# 🚨 Déploiement d'Urgence - CRM BhConnect

## ❌ Problème identifié
L'application Laravel ne démarre pas sur Railway à cause de problèmes de base de données.

## ✅ Solution d'urgence
Utiliser une page de test simple qui fonctionne sans base de données.

## 🚀 Instructions de déploiement

### Étape 1 : Supprimer l'ancien projet
1. Allez sur [railway.app](https://railway.app)
2. Supprimez complètement le projet actuel
3. Créez un nouveau projet

### Étape 2 : Déployer la version de test
1. Cliquez sur "New Project"
2. Sélectionnez "Deploy from GitHub repo"
3. Choisissez `CodeurFMJ/crm-bhconnect`
4. **IMPORTANT** : Renommez `railway-test.json` en `railway.json`
5. Cliquez sur "Deploy Now"

### Étape 3 : Tester l'application
1. Attendez que le déploiement soit terminé
2. Cliquez sur le domaine généré
3. Vous devriez voir la page de test BhConnect
4. Vérifiez que toutes les informations s'affichent

### Étape 4 : Configurer la base de données (optionnel)
1. Ajoutez PostgreSQL dans Railway
2. Récupérez la `DATABASE_URL`
3. Ajoutez-la comme variable d'environnement
4. Redéployez l'application

## 📋 Variables d'environnement minimales
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
- ✅ Variables d'environnement affichées

## 🆘 Si ça ne fonctionne toujours pas
1. Vérifiez les logs Railway
2. Assurez-vous que `railway-test.json` est renommé en `railway.json`
3. Vérifiez que le port est correct
4. Contactez le support Railway

## 📝 Prochaines étapes
Une fois que la page de test fonctionne :
1. Configurer la base de données
2. Restaurer l'application Laravel complète
3. Tester toutes les fonctionnalités
4. Configurer un domaine personnalisé
