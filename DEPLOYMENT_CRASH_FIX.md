# 🚨 Fix d'urgence - Application qui crash

## ❌ Problème
L'application Laravel crash sur Railway à cause de dépendances complexes.

## ✅ Solution
Utiliser PHP pur avec une page de test simple.

## 🚀 Instructions de déploiement

### Étape 1 : Supprimer l'ancien projet
1. Allez sur [railway.app](https://railway.app)
2. Supprimez complètement le projet qui crash
3. Créez un nouveau projet

### Étape 2 : Déployer la version PHP pure
1. Cliquez sur "New Project"
2. Sélectionnez "Deploy from GitHub repo"
3. Choisissez `CodeurFMJ/crm-bhconnect`
4. **IMPORTANT** : Renommez `composer-minimal.json` en `composer.json`
5. Cliquez sur "Deploy Now"

### Étape 3 : Tester l'application
1. Attendez que le déploiement soit terminé
2. Cliquez sur le domaine généré
3. Vous devriez voir la page de test BhConnect
4. Vérifiez que toutes les informations s'affichent

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
- ✅ Variables d'environnement affichées
- ✅ Interface responsive

## 🆘 Si ça ne fonctionne toujours pas
1. Vérifiez les logs Railway
2. Assurez-vous que `composer-minimal.json` est renommé en `composer.json`
3. Vérifiez que le port est correct
4. Contactez le support Railway

## 📝 Prochaines étapes
Une fois que la page de test fonctionne :
1. Configurer la base de données
2. Restaurer l'application Laravel complète
3. Tester toutes les fonctionnalités
4. Configurer un domaine personnalisé
