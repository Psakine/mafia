FROM php:8.1-fpm-bullseye

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip libpq-dev npm python3 \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && docker-php-ext-enable pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

COPY ./php.ini /usr/local/etc/php

WORKDIR /var/www/backend

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN git config --global user.email "kol2133@yandex.ru" \
    && git config --global user.name "nicolay" \
