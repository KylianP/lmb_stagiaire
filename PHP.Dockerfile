FROM php:5.6-fpm

RUN docker-php-ext-install pdo pdo_mysql mysqli

# RUN pecl install xdebug && docker-php-ext-enable xdebug