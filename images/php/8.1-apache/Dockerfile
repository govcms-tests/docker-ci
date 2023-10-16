# Use the PHP 8.1 with Apache base image
FROM php:8.1-apache

# Set the timezone to Australia/Sydney
RUN ln -sf /usr/share/zoneinfo/Australia/Sydney /etc/localtime

# Use UTF-8 locale
RUN locale-gen C.UTF-8 || true
ENV LANG=C.UTF-8

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set non-interactive mode for APT
RUN echo 'APT::Get::Assume-Yes "true";' > /etc/apt/apt.conf.d/90govcmsci \
    && echo 'DPkg::Options "--force-confnew";' >> /etc/apt/apt.conf.d/90govcmsci
ENV DEBIAN_FRONTEND=noninteractive

# Install system dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    openssh-client git rsync unzip locales mariadb-client

# Install PHP extensions
RUN apt-get install -y --no-install-recommends \
    libfreetype6-dev libjpeg-dev libpng-dev libpq-dev libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg=/usr \
    && docker-php-ext-install -j "$(nproc)" gd opcache pdo_mysql zip

# Install Node.js and Yarn
RUN apt-get install -y apt-transport-https && \
    curl -sL https://deb.nodesource.com/setup_18.x -o nodesource_setup.sh && \
    bash nodesource_setup.sh && \
    apt-get install -y nodejs && \
    npm install -g npm@latest && \
    npm install -g yarn@latest

# Set environment variables
ENV TERM xterm
ENV npm_config_loglevel warn
ENV npm_config_unsafe_perm true

# Install Cypress dependencies
RUN apt-get install -y \
    libgtk2.0-0 libgtk-3-0 libgbm-dev \
    libnotify-dev \
    libgconf-2-4 libnss3 libxss1 \
    libasound2 libxtst6 xauth xvfb

# Clean up the installation files
RUN apt-get autoclean && apt-get autoremove && rm -rf /var/lib/apt/lists/*

# Configure PHP settings
RUN echo 'memory_limit = -1' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini
RUN { \
    echo 'opcache.memory_consumption=128'; \
    echo 'opcache.interned_strings_buffer=8'; \
    echo 'opcache.max_accelerated_files=4000'; \
    echo 'opcache.revalidate_freq=60'; \
    echo 'opcache.fast_shutdown=1'; \
    } > /usr/local/etc/php/conf.d/opcache-recommended.ini

# Install Dockerize
RUN DOCKERIZE_URL="https://circle-downloads.s3.amazonaws.com/circleci-images/cache/linux-amd64/dockerize-latest.tar.gz" && \
    curl --silent --show-error --location --fail --retry 3 --output /tmp/dockerize-linux-amd64.tar.gz $DOCKERIZE_URL && \
    tar -C /usr/local/bin -xzvf /tmp/dockerize-linux-amd64.tar.gz && \
    rm -rf /tmp/dockerize-linux-amd64.tar.gz && \
    dockerize --version

# Copy Composer binary and set memory limit
COPY --from=composer /usr/bin/composer /usr/local/bin/
ENV COMPOSER_MEMORY_LIMIT=-1