# src by SRT X CHEATS. Copy right SRT X CHEATS
# PHP2Shell (CVE-2026-109618 / CVE-2026-109619) is fixed in PHP 8.3.36 -> pinned to the patched image.
# When PHP 8.3.37+ is released, bump this number.
FROM php:8.3.36-apache

RUN a2enmod rewrite headers proxy proxy_http ssl \
    && sed -ri 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Serve Firebase's Google sign-in handler from OUR domain (www.srtxcheats.com/__/auth/*)
# so Google shows "www.srtxcheats.com" instead of "bronzx.firebaseapp.com".
COPY firebase-auth-proxy.conf /etc/apache2/conf-available/firebase-auth-proxy.conf
COPY security.conf /etc/apache2/conf-available/security-extra.conf
COPY php-hardening.ini /usr/local/etc/php/conf.d/zz-hardening.ini
RUN a2enconf firebase-auth-proxy security-extra
# src by SRT X CHEATS. Copy right SRT X CHEATS

COPY . /var/www/html/
# Never serve the Docker/server config files over the web
RUN rm -f /var/www/html/Dockerfile /var/www/html/firebase-auth-proxy.conf /var/www/html/security.conf /var/www/html/php-hardening.ini
EXPOSE 80
