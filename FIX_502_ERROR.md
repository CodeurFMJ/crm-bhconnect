# 🚨 Fix Erreur 502 - Mauvaise passerelle

## ❌ **Problème**
Erreur 502 - L'application ne démarre pas correctement.

## 🔍 **Causes possibles**
- Base de données non accessible
- Variables d'environnement manquantes
- Script de démarrage qui échoue
- Port non configuré correctement

## 🔧 **Solutions**

### **Solution 1 : Vérifier les logs Railway**
1. Allez sur [railway.app](https://railway.app)
2. Cliquez sur votre projet CRM BhConnect
3. Allez dans l'onglet "Deployments"
4. Cliquez sur le déploiement actuel
5. Regardez les logs pour voir l'erreur exacte

### **Solution 2 : Vérifier les variables d'environnement**
Assurez-vous que ces variables sont définies :

```bash
DATABASE_URL=postgresql://postgres:[password]@db.[project].supabase.co:5432/postgres
APP_NAME=CRM BhConnect
APP_ENV=production
APP_DEBUG=false
APP_URL=https://votre-domaine.railway.app
APP_KEY=base64:PKGJbGg/WRENhBrcAHRWtvLOCzTszrtyfzGoh1j9xP8=
```

### **Solution 3 : Utiliser la configuration simplifiée**
1. Renommez `railway-simple-fix.json` en `railway.json`
2. Redéployez l'application
3. Cette configuration est plus simple et plus fiable

### **Solution 4 : Vérifier Supabase**
1. Allez sur [supabase.com](https://supabase.com)
2. Vérifiez que votre projet est créé
3. Vérifiez que la base de données est accessible
4. Testez la connection string

## 🚀 **Configuration simplifiée recommandée**

### **Étape 1 : Supprimer l'ancien projet**
1. Allez sur [railway.app](https://railway.app)
2. Supprimez l'ancien projet qui ne fonctionne pas
3. Créez un nouveau projet

### **Étape 2 : Utiliser la configuration simple**
1. Renommez `railway-simple-fix.json` en `railway.json`
2. Déployez l'application
3. Ajoutez les variables d'environnement

### **Étape 3 : Tester l'application**
1. Attendez que le déploiement soit terminé
2. Ouvrez votre application
3. Vous devriez voir la page de test BhConnect

## 🎯 **Résultat attendu**

- ✅ **Application fonctionnelle** - Plus d'erreur 502
- ✅ **Base de données** - Configurée et accessible
- ✅ **Connexion** - admin@example.com / password
- ✅ **Dashboard complet** - Toutes les fonctionnalités disponibles

## 🆘 **Si l'erreur persiste**

1. Vérifiez les logs Railway
2. Vérifiez que toutes les variables sont définies
3. Vérifiez que Supabase est accessible
4. Redéployez manuellement si nécessaire
5. Contactez le support Railway si nécessaire
