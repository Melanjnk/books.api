FROM composer:1 as composer
FROM php:7.4-fpm-alpine

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apk add --no-cache bash
RUN apk update && apk upgrade && \
    apk add --no-cache bash git openssh

RUN apk update && apk add \
    postgresql-dev \
    icu-dev \
    autoconf \
    g++ \
    make \
    rabbitmq-c-dev

RUN docker-php-ext-install \
        pdo_pgsql \
        opcache \
        intl \
        sockets

RUN pecl install \
        xdebug  \
        amqp \
    && docker-php-ext-enable \
        xdebug \
        amqp

COPY php.ini ${PHP_INI_DIR}
COPY conf.d/opcache.ini ${PHP_INI_DIR}/conf.d/

WORKDIR /var/www