FROM php:8.1-cli-alpine
FROM composer:2 as composer

RUN apk add --no-cache git rsync freetype-dev libjpeg-turbo-dev libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg=/usr \
    && docker-php-ext-install -j "$(nproc)" gd

COPY --from=composer /usr/bin/composer /usr/local/bin/
ENV COMPOSER_MEMORY_LIMIT=-1