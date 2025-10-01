# 🗄️ Guide d'import de la base de données dans Supabase

## 📋 Méthode 1 : Export automatique (Recommandée)

### Étape 1 : Exporter la base de données locale
```bash
# Exécuter le script d'export
php export-local-db.php
```

### Étape 2 : Récupérer le fichier d'export
- Le fichier `database-export.sql` sera créé
- Il contient toutes vos données locales

### Étape 3 : Importer dans Supabase
1. Allez sur [supabase.com](https://supabase.com)
2. Ouvrez votre projet `crm-bhconnect`
3. Allez dans "SQL Editor"
4. Copiez le contenu de `database-export.sql`
5. Collez-le dans l'éditeur SQL
6. Cliquez sur "Run"

## 📋 Méthode 2 : Export manuel

### Étape 1 : Exporter via pg_dump (si PostgreSQL local)
```bash
# Exporter la base de données
pg_dump -h localhost -U votre_utilisateur -d crm_bhconnect > database-export.sql
```

### Étape 2 : Exporter via Laravel Tinker
```bash
# Ouvrir Tinker
php artisan tinker

# Exporter les données
$users = App\Models\User::all();
$clients = App\Models\Client::all();
$appointments = App\Models\Appointment::all();
$tasks = App\Models\Task::all();

# Sauvegarder en JSON
file_put_contents('users.json', $users->toJson());
file_put_contents('clients.json', $clients->toJson());
file_put_contents('appointments.json', $appointments->toJson());
file_put_contents('tasks.json', $tasks->toJson());
```

## 📋 Méthode 3 : Import via l'interface Supabase

### Étape 1 : Préparer les données
1. Allez dans Supabase → "Table Editor"
2. Créez les tables manuellement ou utilisez les migrations Laravel

### Étape 2 : Importer les données
1. Pour chaque table, cliquez sur "Insert" → "Insert row"
2. Ajoutez vos données une par une
3. Ou utilisez l'import CSV si disponible

## 📋 Méthode 4 : Utiliser les migrations Laravel

### Étape 1 : Configurer Supabase
1. Ajoutez `DATABASE_URL` de Supabase dans Railway
2. Railway va automatiquement exécuter les migrations
3. Les seeders vont créer les données de test

### Étape 2 : Ajouter vos données
1. Connectez-vous à l'application
2. Utilisez l'interface pour ajouter vos données
3. Ou utilisez l'import CSV disponible

## 🔧 Configuration Supabase

### Variables d'environnement à ajouter dans Railway
```bash
DATABASE_URL=postgresql://postgres:[password]@db.[project].supabase.co:5432/postgres
APP_NAME=CRM BhConnect
APP_ENV=production
APP_DEBUG=false
APP_URL=https://votre-domaine.railway.app
APP_KEY=base64:PKGJbGg/WRENhBrcAHRWtvLOCzTszrtyfzGoh1j9xP8=
```

## 🧪 Test de l'import

### Vérifier que les données sont importées
1. Allez dans Supabase → "Table Editor"
2. Vérifiez que les tables existent
3. Vérifiez que les données sont présentes
4. Testez l'application Railway

### Comptes de test créés
- **Admin** : admin@example.com / password
- **Utilisateur** : user@example.com / password

## 🆘 Résolution des problèmes

### Erreur de connexion
- Vérifiez que `DATABASE_URL` est correcte
- Vérifiez que Supabase est accessible
- Vérifiez les logs Railway

### Données manquantes
- Vérifiez que l'export s'est bien passé
- Vérifiez que l'import s'est bien passé
- Vérifiez les permissions Supabase

### Erreur de migration
- Vérifiez que les migrations Laravel sont compatibles
- Vérifiez que PostgreSQL est configuré correctement
- Vérifiez les logs Railway

## 📊 Avantages de Supabase

- ✅ **Gratuit** - 500MB de stockage
- ✅ **PostgreSQL** - Compatible avec Laravel
- ✅ **Interface web** - Facile à gérer
- ✅ **Rapide** - Configuration en 5 minutes
- ✅ **Fiable** - Service professionnel
- ✅ **Scalable** - Peut grandir avec votre application
