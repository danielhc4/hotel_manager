
# Etapa 1: compilar los recursos de Vue y Vite
FROM node:22-alpine AS frontend

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY . .
RUN npm run build


# Etapa 2: instalar dependencias PHP
FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install \
#    --no-dev \
    --prefer-dist \
    --no-interaction \
    --no-scripts \
    --no-autoloader

COPY . .

RUN composer dump-autoload \
#    --no-dev \
    --optimize \
    --no-scripts


# Etapa 3: aplicación Laravel con PHP-FPM
FROM php:8.3-fpm-alpine AS app

RUN apk add --no-cache \
    icu-dev \
    libzip-dev \
    oniguruma-dev \
    $PHPIZE_DEPS

RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    bcmath \
    exif \
    pcntl \
    intl \
    zip \
    opcache

WORKDIR /var/www

COPY --from=vendor /app /var/www
COPY --from=frontend /app/public/build /var/www/public/build

RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["entrypoint.sh"]

# Etapa 4: servidor web
FROM nginx:alpine AS web

COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY --from=app /var/www/public /var/www/public

EXPOSE 80