#Apache

FROM php:8.2.4-apache

RUN a2enmod rewrite

RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql

COPY apache.conf /etc/apache2/sites-available/000-default.conf

#________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________#

#Nginx

# FROM php:8.2.4-fpm

# RUN docker-php-ext-install pdo
# RUN docker-php-ext-install pdo_mysql

# # JIT enable
# RUN docker-php-ext-install opcache
# RUN echo 'opcache.enable_cli=1\nopcache.jit_buffer_size=50M\nopcache.jit=tracing\n' >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini

# WORKDIR /var/www

