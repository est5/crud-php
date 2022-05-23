FROM php:8.1.6-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl 

RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

WORKDIR /var/www    