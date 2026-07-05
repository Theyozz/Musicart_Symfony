FROM php:8.4-fpm-alpine
RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN docker-php-ext-install opcache

WORKDIR /code
COPY . /code