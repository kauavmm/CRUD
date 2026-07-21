FROM php:8.3-apache

# Install extensions MySQLi and PDO
RUN docker-php-ext-install mysqli pdo_mysql \
    && docker-php-ext-enable mysqli pdo_mysql

RUN a2enmod rewrite
