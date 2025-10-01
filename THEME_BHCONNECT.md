# Thème BhConnect - Documentation

## Vue d'ensemble

Le CRM a été entièrement personnalisé avec la palette de couleurs et l'identité visuelle de BhConnect. Cette personnalisation reflète les couleurs du logo de l'entreprise : orange vibrant (#FF6B35) et bleu foncé (#1B365D).

## Couleurs utilisées

### Couleurs principales
- **Orange BhConnect** : `#FF6B35` - Couleur principale pour les boutons, liens actifs et éléments d'accent
- **Bleu BhConnect** : `#1B365D` - Couleur secondaire pour les textes, bordures et éléments de navigation
- **Orange clair** : `#FF8A5B` - Variante plus claire pour les effets hover
- **Orange foncé** : `#E55A2B` - Variante plus foncée pour les états actifs
- **Bleu clair** : `#2A4A6B` - Variante plus claire du bleu principal
- **Bleu foncé** : `#0F2438` - Variante plus foncée du bleu principal

### Couleurs secondaires
- **Gris** : `#6C757D` - Pour les textes secondaires
- **Gris clair** : `#F8F9FA` - Pour les arrière-plans
- **Gris foncé** : `#495057` - Pour les textes tertiaires

## Éléments personnalisés

### Logo BhConnect
- Intégration du logo avec l'avion stylisé
- "Bh" en orange et "Connect" en bleu
- Tagline "Nous réalisons vos rêves" en bleu
- Icône d'avion orange avec rotation de 15°

### Navigation
- Barre de navigation avec bordure orange en bas
- Logo BhConnect dans la navbar
- Liens de navigation en bleu avec effet hover orange
- Sidebar avec éléments actifs en orange

### Boutons
- Boutons principaux : fond orange avec texte blanc
- Boutons secondaires : fond bleu avec texte blanc
- Boutons outline : bordure orange/bleu avec texte coloré
- Effets hover avec transitions fluides

### Cartes et composants
- Cartes avec ombres personnalisées
- Headers de cartes avec fond gris clair
- Bordures arrondies cohérentes
- Effets hover sur les cartes du dashboard

### Formulaires
- Focus sur les champs avec bordure orange
- Messages d'erreur avec couleurs appropriées
- Labels en bleu foncé

### Tableaux
- Headers de tableaux avec fond bleu et texte blanc
- Lignes hover avec fond orange transparent
- Badges colorés selon le statut

## Fichiers modifiés

### CSS
- `resources/css/bhconnect-theme.css` - Thème principal
- `public/css/bhconnect-theme.css` - Version compilée

### Vues
- `resources/views/auth/login.blade.php` - Page de connexion
- `resources/views/welcome.blade.php` - Tableau de bord
- `resources/views/admin/users/create.blade.php` - Création d'utilisateur
- `resources/views/admin/users/index.blade.php` - Liste des utilisateurs
- `resources/views/clients/index.blade.php` - Liste des clients
- `resources/views/proformas/index.blade.php` - Liste des proformas
- `resources/views/layouts/app.blade.php` - Template de base

### Configuration
- `webpack.mix.js` - Configuration de compilation CSS

## Utilisation

### Classes CSS personnalisées
```css
.text-bh-orange     /* Texte orange BhConnect */
.text-bh-blue       /* Texte bleu BhConnect */
.bg-bh-orange       /* Arrière-plan orange */
.bg-bh-blue         /* Arrière-plan bleu */
.border-bh-orange   /* Bordure orange */
.border-bh-blue     /* Bordure bleue */
.bhconnect-logo     /* Logo BhConnect */
.dashboard-card     /* Cartes du dashboard avec effet hover */
.page-header        /* En-têtes de page stylisés */
```

### Intégration dans les vues
```html
<!-- Logo BhConnect -->
<a class="navbar-brand bhconnect-logo" href="#">
    <div class="logo-text">
        <span class="logo-bh">Bh</span><span class="logo-connect">Connect</span>
        <i class="bi bi-airplane logo-airplane"></i>
    </div>
</a>

<!-- En-tête de page -->
<div class="page-header">
    <h1 class="h3 mb-0">Titre de la page</h1>
    <p class="text-muted">Description</p>
</div>
```

## Compilation

Pour compiler les assets CSS :
```bash
npm run dev
```

Pour la production :
```bash
npm run prod
```

## Responsive Design

Le thème est entièrement responsive et s'adapte aux différentes tailles d'écran :
- Mobile : Logo réduit, navigation simplifiée
- Tablette : Layout adaptatif
- Desktop : Interface complète avec sidebar

## Accessibilité

- Contraste élevé entre les couleurs
- Indicateurs visuels clairs pour les états actifs
- Navigation claire et intuitive
- Support des lecteurs d'écran

## Maintenance

Pour ajouter de nouvelles couleurs ou modifier le thème :
1. Modifier les variables CSS dans `resources/css/bhconnect-theme.css`
2. Compiler avec `npm run dev`
3. Tester sur toutes les pages concernées

## Notes techniques

- Utilisation de CSS Custom Properties (variables CSS) pour faciliter la maintenance
- Compatible avec Bootstrap 5.3.8
- Support des icônes Bootstrap Icons
- Compilation avec Laravel Mix et PostCSS
