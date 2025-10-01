# 🗄️ Configuration de la base de données

## Option 1 : Supabase (Recommandé)

### 1. Créer un compte Supabase
1. Allez sur [supabase.com](https://supabase.com)
2. Cliquez sur "Start your project"
3. Créez un compte avec GitHub/Google
4. Cliquez sur "New Project"

### 2. Configurer le projet
1. **Nom du projet** : `crm-bhconnect`
2. **Mot de passe** : Choisissez un mot de passe fort
3. **Région** : Choisissez la plus proche de vous
4. Cliquez sur "Create new project"

### 3. Récupérer les informations de connexion
1. Attendez que le projet soit créé (2-3 minutes)
2. Allez dans "Settings" → "Database"
3. Copiez la "Connection string"
4. Elle ressemble à : `postgresql://postgres:[password]@db.[project].supabase.co:5432/postgres`

### 4. Ajouter dans Railway
1. Allez dans Railway → Votre projet → Variables
2. Ajoutez une nouvelle variable :
   - **Nom** : `DATABASE_URL`
   - **Valeur** : (collez la connection string)
3. Railway va redéployer automatiquement

## Option 2 : PlanetScale (MySQL)

### 1. Créer un compte PlanetScale
1. Allez sur [planetscale.com](https://planetscale.com)
2. Cliquez sur "Get started for free"
3. Créez un compte avec GitHub
4. Cliquez sur "Create database"

### 2. Configurer la base de données
1. **Nom** : `crm-bhconnect`
2. **Région** : Choisissez la plus proche
3. Cliquez sur "Create database"

### 3. Récupérer les informations de connexion
1. Cliquez sur "Connect"
2. Sélectionnez "General purpose"
3. Copiez la "Connection string"
4. Elle ressemble à : `mysql://[username]:[password]@[host]/[database]?sslaccept=strict`

### 4. Ajouter dans Railway
1. Allez dans Railway → Votre projet → Variables
2. Ajoutez une nouvelle variable :
   - **Nom** : `DATABASE_URL`
   - **Valeur** : (collez la connection string)
3. Railway va redéployer automatiquement

## Option 3 : Neon (PostgreSQL)

### 1. Créer un compte Neon
1. Allez sur [neon.tech](https://neon.tech)
2. Cliquez sur "Get started for free"
3. Créez un compte avec GitHub/Google
4. Cliquez sur "Create project"

### 2. Configurer le projet
1. **Nom du projet** : `crm-bhconnect`
2. **Région** : Choisissez la plus proche
3. Cliquez sur "Create project"

### 3. Récupérer les informations de connexion
1. Allez dans "Dashboard" → "Connection Details"
2. Copiez la "Connection string"
3. Elle ressemble à : `postgresql://[username]:[password]@[host]/[database]?sslmode=require`

### 4. Ajouter dans Railway
1. Allez dans Railway → Votre projet → Variables
2. Ajoutez une nouvelle variable :
   - **Nom** : `DATABASE_URL`
   - **Valeur** : (collez la connection string)
3. Railway va redéployer automatiquement

## Option 4 : Base de données locale (Développement)

### 1. Installer PostgreSQL localement
```bash
# Windows (avec Chocolatey)
choco install postgresql

# Ou télécharger depuis postgresql.org
```

### 2. Créer une base de données
```sql
CREATE DATABASE crm_bhconnect;
CREATE USER crm_user WITH PASSWORD 'votre_mot_de_passe';
GRANT ALL PRIVILEGES ON DATABASE crm_bhconnect TO crm_user;
```

### 3. Configurer .env local
```bash
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=crm_bhconnect
DB_USERNAME=crm_user
DB_PASSWORD=votre_mot_de_passe
```

## 🔍 Vérification

Après avoir configuré la base de données :
1. Railway va redéployer automatiquement
2. L'application va exécuter les migrations
3. Le compte administrateur sera créé
4. Vous pourrez vous connecter avec :
   - **Email** : `admin@example.com`
   - **Mot de passe** : `password`
