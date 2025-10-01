# 🗄️ Configuration de la base de données locale

## Option 1: XAMPP (Windows)

1. **Télécharger XAMPP** : [https://www.apachefriends.org](https://www.apachefriends.org)
2. **Installer et démarrer** Apache + MySQL
3. **Créer une base de données** :
   - Aller sur http://localhost/phpmyadmin
   - Créer une base : `crm_bhconnect`

4. **Configurer le .env** :
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=crm_bhconnect
   DB_USERNAME=root
   DB_PASSWORD=
   ```

## Option 2: Docker (Recommandé)

1. **Installer Docker Desktop**
2. **Créer un docker-compose.yml** :
   ```yaml
   version: '3.8'
   services:
     mysql:
       image: mysql:8.0
       environment:
         MYSQL_ROOT_PASSWORD: password
         MYSQL_DATABASE: crm_bhconnect
       ports:
         - "3306:3306"
   ```

3. **Démarrer** : `docker-compose up -d`

## Option 3: PostgreSQL local

1. **Installer PostgreSQL** : [https://www.postgresql.org](https://www.postgresql.org)
2. **Créer une base de données** :
   ```sql
   CREATE DATABASE crm_bhconnect;
   ```

3. **Configurer le .env** :
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=crm_bhconnect
   DB_USERNAME=postgres
   DB_PASSWORD=votre_mot_de_passe
   ```

## Commandes après configuration

```bash
# Exécuter les migrations
php artisan migrate

# Seeder les données
php artisan db:seed

# Démarrer l'application
php artisan serve
```
