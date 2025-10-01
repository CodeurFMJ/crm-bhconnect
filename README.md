# 🚀 CRM-Bh Connect

Un système de gestion de la relation client (CRM) moderne et professionnel développé avec Laravel, conçu spécialement pour l'entreprise BhConnect.

## ✨ Fonctionnalités

### 🎯 **Gestion des clients**
- Création et gestion des profils clients
- Suivi des informations personnelles et commerciales
- Historique des interactions

### 📅 **Gestion des rendez-vous**
- Planification des rendez-vous
- Système d'approbation pour les administrateurs
- Notifications automatiques

### 📊 **Objectifs de performance**
- Définition d'objectifs par l'administrateur
- Suivi des performances en temps réel
- Tableaux de bord personnalisés

### 📄 **Gestion des proformas**
- Création de proformas personnalisées
- Constructeur de proformas intégré
- Suivi des statuts

### 📋 **Gestion des tâches**
- Attribution de tâches aux employés
- Suivi des priorités et échéances
- Tableaux de bord des tâches

### 📈 **Rapports et analyses**
- Rapports financiers détaillés
- Statistiques de performance
- Export des données

### 📤 **Import/Export CSV**
- Import de données clients
- Export complet des données
- Tableaux structurés et organisés

### 🔔 **Système de notifications**
- Notifications en temps réel
- Alertes pour les rendez-vous
- Suivi des activités

## 🎨 **Design et interface**

- **Thème BhConnect** : Couleurs orange (#FF6B35) et bleu (#1B365D)
- **Logo professionnel** : Intégration du logo BhConnect
- **Interface responsive** : Adaptation mobile, tablette et desktop
- **Design moderne** : Interface utilisateur intuitive et professionnelle

## 🛠️ **Technologies utilisées**

- **Backend** : Laravel 8.x
- **Frontend** : Bootstrap 5.3.8, Blade Templates
- **Base de données** : MySQL/PostgreSQL
- **CSS** : Thème personnalisé BhConnect
- **JavaScript** : Vanilla JS avec Bootstrap Icons
- **Build** : Laravel Mix, Webpack

## 📋 **Prérequis**

- PHP 7.3 ou supérieur
- Composer
- Node.js et NPM
- MySQL ou PostgreSQL
- Serveur web (Apache/Nginx)

## 🚀 **Installation**

### 1. Cloner le repository
```bash
git clone https://github.com/votre-username/crm-bhconnect.git
cd crm-bhconnect
```

### 2. Installer les dépendances
```bash
composer install
npm install
```

### 3. Configuration de l'environnement
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configuration de la base de données
Modifier le fichier `.env` :
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crm_bhconnect
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Exécuter les migrations
```bash
php artisan migrate
php artisan db:seed
```

### 6. Compiler les assets
```bash
npm run dev
# ou pour la production
npm run build
```

### 7. Démarrer le serveur
```bash
php artisan serve
```

L'application sera accessible sur `http://localhost:8000`

## 👥 **Utilisateurs par défaut**

### Administrateur
- **Email** : admin@bhconnect.com
- **Mot de passe** : password

### Employé
- **Email** : employee@bhconnect.com
- **Mot de passe** : password

## 🌐 **Déploiement**

### Déploiement gratuit avec Railway
1. Pousser le code sur GitHub
2. Se connecter sur [Railway.app](https://railway.app)
3. Créer un nouveau projet depuis GitHub
4. Ajouter une base de données PostgreSQL
5. Configurer les variables d'environnement
6. Exécuter les migrations

Voir `DEPLOYMENT_GUIDE.md` pour un guide détaillé.

## 📁 **Structure du projet**

```
crm-bhconnect/
├── app/
│   ├── Http/Controllers/     # Contrôleurs
│   ├── Models/              # Modèles Eloquent
│   └── ...
├── database/
│   ├── migrations/          # Migrations de base de données
│   └── seeders/            # Seeders pour les données de test
├── resources/
│   ├── views/              # Vues Blade
│   ├── css/               # Styles CSS
│   └── js/                # JavaScript
├── public/
│   ├── css/               # CSS compilé
│   ├── js/                # JS compilé
│   └── images/            # Images et logos
└── routes/
    └── web.php            # Routes web
```

## 🔧 **Configuration avancée**

### Variables d'environnement importantes
```env
APP_NAME="CRM-Bh Connect"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

# Base de données
DB_CONNECTION=pgsql
DB_HOST=your-db-host
DB_PORT=5432
DB_DATABASE=your-db-name
DB_USERNAME=your-db-user
DB_PASSWORD=your-db-password

# Cache et sessions
CACHE_DRIVER=file
SESSION_DRIVER=file
```

## 📊 **Fonctionnalités d'administration**

- **Gestion des utilisateurs** : Création, modification, suppression
- **Objectifs de performance** : Définition et suivi des objectifs
- **Import/Export CSV** : Gestion des données
- **Logs d'activité** : Suivi des actions des utilisateurs
- **Statistiques** : Tableaux de bord et rapports

## 🎯 **Objectifs de performance**

Le système permet de définir et suivre :
- Chiffre d'affaires (mensuel, trimestriel, annuel)
- Nombre de clients
- Rendez-vous planifiés
- Tâches complétées
- Taux de conversion

## 📱 **Responsive Design**

L'interface s'adapte automatiquement à :
- **Mobile** : Interface optimisée pour les smartphones
- **Tablette** : Layout adaptatif pour les tablettes
- **Desktop** : Interface complète pour les ordinateurs

## 🔒 **Sécurité**

- Authentification utilisateur
- Protection CSRF
- Validation des données
- Gestion des rôles et permissions
- Logs de sécurité

## 📈 **Performance**

- Cache des configurations
- Optimisation des requêtes
- Assets minifiés
- Compression des images

## 🤝 **Contribution**

1. Fork le projet
2. Créer une branche pour votre fonctionnalité
3. Commiter vos changements
4. Pousser vers la branche
5. Ouvrir une Pull Request

## 📄 **Licence**

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## 📞 **Support**

Pour toute question ou problème :
- Consulter la documentation
- Vérifier les issues GitHub
- Contacter l'équipe de développement

## 🎉 **Remerciements**

- Laravel Framework
- Bootstrap
- Bootstrap Icons
- Tous les contributeurs

---

**Développé avec ❤️ pour BhConnect**

*"Nous réalisons vos rêves"* ✈️