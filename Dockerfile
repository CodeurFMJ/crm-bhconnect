# Utiliser l'image PHP officielle avec Apache
FROM php:8.1-apache

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip \
    nodejs \
    npm \
    && rm -rf /var/lib/apt/lists/*

# Installer les extensions PHP
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

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

# Rendre le script de démarrage exécutable
RUN chmod +x start.sh

# Configurer Apache pour Laravel
RUN a2enmod rewrite
RUN echo '<Directory /var/www/html/public>\n    AllowOverride All\n    Require all granted\n</Directory>' > /etc/apache2/sites-available/000-default.conf

# Exposer le port
EXPOSE 8080

# Commande de démarrage
CMD ["./start.sh"]
