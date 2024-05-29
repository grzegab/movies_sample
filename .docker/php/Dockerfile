FROM php:8.3-fpm as base

MAINTAINER Grzegorz Gabryel <greg@grzegab.eu>

RUN apt-get update && apt-get install -y libpq-dev libzip-dev zlib1g-dev unzip libicu-dev xvfb libfontconfig wkhtmltopdf

RUN pecl install pcov xdebug

RUN docker-php-ext-install -j$(nproc) pdo pdo_pgsql pgsql zip intl opcache
RUN docker-php-ext-enable opcache pcov xdebug

RUN rm -rf /var/lib/apt/lists/*

#Install composer form docker
COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY .docker/php/b99-additional.ini $PHP_INI_DIR/conf.d/
COPY .docker/php/z99-xdebug.ini $PHP_INI_DIR/conf.d/

WORKDIR /data/www
