FROM php:8.4-cli

WORKDIR /app

RUN apt-get update && apt-get install -y \
    curl \
    git \
    zip \
    unzip \
    libzip-dev \
    libicu-dev \
    libpq-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    netcat-openbsd \
    mariadb-client \
    gnupg \
    ca-certificates \
    build-essential \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
    zip \
    pcntl \
    intl \
    pdo \
    pdo_mysql \
    mysqli \
    mbstring \
    exif \
    gd \
    opcache \
    && docker-php-ext-enable opcache

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g prettier

COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

COPY --chown=www-data:www-data . /app

COPY composer.json composer.lock ./
RUN composer install --prefer-dist --no-scripts --no-dev --no-interaction --optimize-autoloader

COPY package*.json ./
RUN npm install

COPY . .

RUN composer dump-autoload --optimize && \
    chown -R www-data:www-data storage

RUN composer require laravel/octane && \
    php artisan octane:install --server=frankenphp

COPY docker/app-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/app-entrypoint.sh

ENTRYPOINT ["app-entrypoint.sh"]
EXPOSE 8000 5173
