FROM php:5.6-apache

RUN apt-get update && apt-get install -y \
        libicu-dev \
    && docker-php-ext-install -j$(nproc) intl

COPY ./php.ini /usr/local/etc/php/
COPY . /var/www/html/

RUN usermod -u 1000 www-data
RUN chown -R www-data:www-data /var/www/html/app/cache
RUN chown -R www-data:www-data /var/www/html/app/logs