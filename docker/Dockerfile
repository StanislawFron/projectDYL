FROM node:20-alpine AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm install && \
    npm install --save-dev husky lint-staged prettier && \
    npm pkg set scripts.prepare="husky install" && \
    npm pkg set lint-staged."*"="prettier resources --write" && \
    npx husky install && \
    npx husky add .husky/pre-commit "docker exec -i projectdyl-app sh -c 'npx lint-staged && ./vendor/bin/pint'"
COPY . .
RUN npm run build

FROM php:8.3-fpm AS app
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
    && docker-php-ext-configure zip \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        zip \
        intl
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer
COPY composer.json composer.lock ./
RUN composer install --prefer-dist --no-scripts --no-dev --no-interaction --optimize-autoloader
COPY . .
COPY --from=frontend /app/public/build ./public/build
RUN composer dump-autoload --optimize && \
    chown -R www-data:www-data storage
COPY docker/app-entrypoint.sh /usr/local/bin/app-entrypoint.sh
RUN chmod +x /usr/local/bin/app-entrypoint.sh
ENTRYPOINT ["app-entrypoint.sh"]
CMD ["php-fpm"]
EXPOSE 9000
