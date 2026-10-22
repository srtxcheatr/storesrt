# src by SRT X CHEATS. Copy right SRT X CHEATS
FROM php:8.3-apache

RUN a2enmod rewrite headers proxy proxy_http ssl \
    && sed -ri 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Serve Firebase's Google sign-in handler from OUR domain (www.srtxcheats.com/__/auth/*)
# so Google shows "www.srtxcheats.com" instead of "bronzx.firebaseapp.com".
COPY firebase-auth-proxy.conf /etc/apache2/conf-available/firebase-auth-proxy.conf
RUN a2enconf firebase-auth-proxy
# src by SRT X CHEATS. Copy right SRT X CHEATS

COPY . /var/www/html/
EXPOSE 80
