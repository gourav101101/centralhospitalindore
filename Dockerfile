# Build front-end assets.
FROM node:22-alpine AS assets

WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY resources ./resources
COPY public ./public
COPY vite.config.js ./
RUN npm run build

# Install production PHP dependencies.
FROM composer:2 AS vendor

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader --no-scripts

# Serve Laravel through NGINX and PHP-FPM.
FROM php:8.3-fpm-alpine

WORKDIR /var/www/html

RUN apk add --no-cache nginx gettext postgresql-dev sqlite-dev $PHPIZE_DEPS \
    && docker-php-ext-install pdo_pgsql pdo_sqlite bcmath \
    && mkdir -p /run/nginx

COPY . .
COPY --from=vendor /app/vendor ./vendor
COPY --from=assets /app/public/build ./public/build
COPY docker/nginx.conf.template /etc/nginx/http.d/default.conf.template
COPY docker/start-container /usr/local/bin/start-container

RUN chmod +x /usr/local/bin/start-container \
    && mkdir -p database public/uploads/doctors public/uploads/blogs public/uploads/testimonials public/uploads/brochures \
    && touch database/database.sqlite \
    && chown -R www-data:www-data storage bootstrap/cache public/uploads database

ENV PORT=10000
EXPOSE 10000

CMD ["/usr/local/bin/start-container"]
