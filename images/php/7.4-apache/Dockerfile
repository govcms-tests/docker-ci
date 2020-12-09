FROM php:7.4-apache

# make Apt non-interactive
RUN echo 'APT::Get::Assume-Yes "true";' > /etc/apt/apt.conf.d/90govcmsci \
    && echo 'DPkg::Options "--force-confnew";' >> /etc/apt/apt.conf.d/90govcmsci

ENV DEBIAN_FRONTEND=noninteractive

RUN a2enmod rewrite

RUN apt-get update \
    && apt-get install -y --no-install-recommends locales mariadb-client libfreetype6-dev libjpeg-dev libpng-dev libpq-dev libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg=/usr \
    && docker-php-ext-install -j "$(nproc)" gd opcache pdo_mysql zip \
    && apt-get autoclean && apt-get autoremove \
    && rm -rf /var/lib/apt/lists/*

# Set timezone to Australia/Sydney by default
RUN ln -sf /usr/share/zoneinfo/Australia/Sydney /etc/localtime

# Use unicode
RUN locale-gen C.UTF-8 || true
ENV LANG=C.UTF-8

# set recommended PHP.ini settings
# see https://secure.php.net/manual/en/opcache.installation.php
RUN { \
    echo 'opcache.memory_consumption=128'; \
    echo 'opcache.interned_strings_buffer=8'; \
    echo 'opcache.max_accelerated_files=4000'; \
    echo 'opcache.revalidate_freq=60'; \
    echo 'opcache.fast_shutdown=1'; \
    } > /usr/local/etc/php/conf.d/opcache-recommended.ini

ENV APACHE_DOCUMENT_ROOT=/app/web

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

CMD ["/bin/sh"]