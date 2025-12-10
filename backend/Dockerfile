FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    git zip unzip libicu-dev libonig-dev libzip-dev \
  && docker-php-ext-install pdo_mysql intl mbstring zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html