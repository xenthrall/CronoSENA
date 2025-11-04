FROM php:8.3-fpm

# -------------------------
# Instalar dependencias del sistema
# -------------------------
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    zip \
    libicu-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libzip-dev \
    libwebp-dev \
    libxml2-dev \
    libxslt1-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install \
        bcmath \
        exif \
        gd \
        intl \
        pdo_mysql \
        zip \
        xsl \
        pcntl \
    && docker-php-ext-enable \
        intl \
        bcmath \
        exif \
        gd \
        xsl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# -------------------------
# Instalar Node.js (LTS actual) y npm
# -------------------------
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

# -------------------------
# Instalar Composer
# -------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# -------------------------
# Configurar el entorno de trabajo
# -------------------------
WORKDIR /var/www/html
