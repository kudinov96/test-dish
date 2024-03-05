FROM composer:latest as composer

FROM php:8.2-fpm as php

RUN set -eux; \
    apt-get update; \
    apt-get install -y --no-install-recommends \
            curl \
            exif \
            git \
            libmemcached-dev \
            libz-dev \
            libjpeg-dev \
            libpng-dev \
            libfreetype6-dev \
            libssl-dev \
            libwebp-dev \
            libxpm-dev \
            libmcrypt-dev \
            libonig-dev \
            zip \
            unzip \
            libzip-dev; \
    docker-php-ext-install pdo_mysql; \
    docker-php-ext-configure gd \
            --prefix=/usr \
            --with-jpeg \
            --with-webp \
            --with-xpm \
            --with-freetype; \
    docker-php-ext-install gd exif; \
    php -r 'var_dump(gd_info());'; \
    rm -rf /var/lib/apt/lists/*; \
    apt-get autoremove -y; \
    apt-get clean

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_MEMORY_LIMIT=-1

COPY --from=composer /usr/bin/composer /usr/local/bin/composer
RUN /usr/local/bin/composer self-update

RUN groupadd -g 1000 www && \
    useradd -u 1000 -ms /bin/sh -g www www

USER www

WORKDIR /var/www/app
EXPOSE 9000
