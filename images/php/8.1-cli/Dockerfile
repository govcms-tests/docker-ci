FROM php:8.1-cli-alpine

RUN apk add --no-cache git patch rsync unzip freetype-dev libjpeg-turbo-dev libpng-dev libzip-dev zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg=/usr \
    && docker-php-ext-configure zip \
    && docker-php-ext-install -j "$(nproc)" gd zip

COPY --from=composer /usr/bin/composer /usr/local/bin/
ENV COMPOSER_MEMORY_LIMIT=-1
ENV COMPOSER_ALLOW_SUPERUSER=1