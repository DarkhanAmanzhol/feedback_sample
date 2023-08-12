FROM php:8.2-apache

WORKDIR /var/www/html/

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN apt-get update && apt-get install -y zip unzip default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer install

COPY . .
RUN composer dump-autoload

CMD ["php", "-S", "0.0.0.0:80"]