# Utiliser l'image PHP officielle avec Apache
FROM php:8.1-apache

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm

# Nettoyer le cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Installer les extensions PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers de l'application
COPY . .

# Installer les dépendances PHP
RUN composer install --optimize-autoloader --no-dev

# Installer les dépendances Node.js et compiler les assets
RUN npm install && npm run build

# Configurer les permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Configurer Apache
RUN a2enmod rewrite
COPY .htaccess /var/www/html/.htaccess

# Exposer le port
EXPOSE 80

# Commande de démarrage
CMD ["apache2-foreground"]
