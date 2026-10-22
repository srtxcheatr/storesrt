# src by SRT X CHEATS. Copy right SRT X CHEATS
FROM php:8.3-apache

RUN a2enmod rewrite headers \
    && sed -ri 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf
# src by SRT X CHEATS. Copy right SRT X CHEATS

COPY . /var/www/html/
EXPOSE 80
