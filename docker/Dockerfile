FROM php:8.3-fpm AS app
WORKDIR /var/www

# Instalacja zależności systemowych
RUN apt-get update && apt-get install -y \
    curl \
    git \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libicu-dev \
    netcat-openbsd \
    gnupg \
    ca-certificates \
    build-essential

# Instalacja Node.js (poprawiona składnia)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g prettier

# Instalacja rozszerzeń PHP (osobny krok)
RUN docker-php-ext-configure zip \
    && docker-php-ext-install pdo pdo_mysql zip intl

# Instalacja Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Kopiowanie i instalacja zależności PHP
COPY composer.json composer.lock ./
RUN composer install --prefer-dist --no-scripts --no-dev --no-interaction --optimize-autoloader

# Kopiowanie i instalacja zależności Node.js
COPY package*.json ./
RUN npm install

# Kopiowanie reszty aplikacji
COPY . .

# Budowa frontendu
RUN npm run build

# Optymalizacja i uprawnienia
RUN composer dump-autoload --optimize && \
    chown -R www-data:www-data storage

# Entrypoint
COPY docker/app-entrypoint.sh /usr/local/bin/app-entrypoint.sh
RUN chmod +x /usr/local/bin/app-entrypoint.sh

ENTRYPOINT ["app-entrypoint.sh"]
CMD ["php-fpm"]

EXPOSE 9000
