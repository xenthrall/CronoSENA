FROM php:8.3-fpm

# -------------------------
# Dependencias del sistema
# -------------------------
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev zip curl gnupg \
    && docker-php-ext-install pdo pdo_mysql zip

# -------------------------
# Instalar Node.js y npm (LTS actual)
# -------------------------
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

# -------------------------
# Instalar Composer
# -------------------------

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
