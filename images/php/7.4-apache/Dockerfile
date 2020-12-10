FROM php:7.4-apache

# make Apt non-interactive
RUN echo 'APT::Get::Assume-Yes "true";' > /etc/apt/apt.conf.d/90govcmsci \
    && echo 'DPkg::Options "--force-confnew";' >> /etc/apt/apt.conf.d/90govcmsci

ENV DEBIAN_FRONTEND=noninteractive

# install service dependencies
RUN apt-get update \
    && apt-get install -y --no-install-recommends git locales mariadb-client

# install PHP dependencies
RUN apt-get install -y --no-install-recommends libfreetype6-dev libjpeg-dev libpng-dev libpq-dev libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg=/usr \
    && docker-php-ext-install -j "$(nproc)" gd opcache pdo_mysql zip

# install Yarn dependencies
RUN apt-get install -y apt-transport-https
RUN curl -sL https://deb.nodesource.com/setup_12.x -o nodesource_setup.sh
RUN bash nodesource_setup.sh
RUN apt-get install -y nodejs
RUN npm install -g npm@latest
RUN npm install -g yarn@latest

# good colors for most applications
ENV TERM xterm
# avoid million NPM install messages
ENV npm_config_loglevel warn
# allow installing when the main user is root
ENV npm_config_unsafe_perm true

# install Cypress dependencies (separate commands to avoid time outs)
RUN apt-get install -y libgtk2.0-0
RUN apt-get install -y libnotify-dev
RUN apt-get install -y libgconf-2-4 libnss3 libxss1
RUN apt-get install -y libasound2 xvfb

# clean up the install files
RUN apt-get autoclean && apt-get autoremove \
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

# install dockerize
RUN DOCKERIZE_URL="https://circle-downloads.s3.amazonaws.com/circleci-images/cache/linux-amd64/dockerize-latest.tar.gz" \
  && curl --silent --show-error --location --fail --retry 3 --output /tmp/dockerize-linux-amd64.tar.gz $DOCKERIZE_URL \
  && tar -C /usr/local/bin -xzvf /tmp/dockerize-linux-amd64.tar.gz \
  && rm -rf /tmp/dockerize-linux-amd64.tar.gz \
  && dockerize --version

# install and config Apache
RUN a2enmod rewrite
ENV APACHE_DOCUMENT_ROOT /app/web
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT:-/app/web}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT:-/app/web}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

CMD ["/bin/sh"]