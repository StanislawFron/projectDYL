FROM node:20-alpine AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

FROM php:8.3-fpm
WORKDIR /var/www

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
    build-essential \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-configure zip \
    && docker-php-ext-install pdo pdo_mysql zip intl

RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

COPY composer.json composer.lock ./
RUN composer install --prefer-dist --no-scripts --no-dev --no-interaction --optimize-autoloader

COPY package*.json ./
RUN npm install && \
    npm install --save-dev husky lint-staged prettier

RUN npx husky install && \
    npx husky add .husky/pre-commit "npx lint-staged && ./vendor/bin/pint"

COPY . .

COPY --from=frontend /app/public/build ./public/build

RUN composer dump-autoload --optimize && \
    chown -R www-data:www-data storage

COPY docker/app-entrypoint.sh /usr/local/bin/app-entrypoint.sh
RUN chmod +x /usr/local/bin/app-entrypoint.sh

ENTRYPOINT ["app-entrypoint.sh"]
CMD ["php-fpm"]

EXPOSE 9000
