FROM php:8.3-fpm

# -------------------------
# Dependencias del sistema
# -------------------------
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev zip curl gnupg libicu-dev libjpeg-dev libpng-dev libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql zip intl bcmath exif gd \
    && docker-php-ext-enable intl bcmath exif gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# -------------------------
# Instalar Node.js y npm (LTS actual)
# -------------------------
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

# -------------------------
# Instalar Composer
# -------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

