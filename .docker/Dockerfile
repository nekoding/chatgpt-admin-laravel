FROM php:8.2-fpm-alpine

WORKDIR /var/www/html/

# Essentials
RUN addgroup -S appkey && adduser -S appkey -G appkey
RUN apk update && apk upgrade && apk add --no-cache zip unzip curl sqlite nginx supervisor bash

# Enable extension
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions; \
    install-php-extensions zip gd

# Installing composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm -rf composer-setup.php

# Configure supervisor
RUN mkdir -p /etc/supervisor.d/
COPY .docker/config/supervisor.ini /etc/supervisor.d/supervisord.ini

# Configure nginx
COPY .docker/config/nginx.conf /etc/nginx/
COPY .docker/config/laravel.conf /etc/nginx/http.d/default.conf
RUN nginx -t

RUN ln -sf /dev/stdout /var/log/nginx/access.log
RUN ln -sf /dev/stderr /var/log/nginx/error.log

# Configure PHP FPM
COPY .docker/config/php.ini /var/local/etc/php
COPY .docker/config/php-fpm.conf /var/local/etc

# Building process
COPY . .
RUN composer install --no-dev

# Setup permission
RUN chown -R www-data:www-data /var/www/html
RUN find /var/www/html/ -type f -exec chmod 644 {} \;
RUN find /var/www/html/ -type d -exec chmod 755 {} \;
RUN chgrp -R www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R ug+rwx /var/www/html/storage /var/www/html/bootstrap/cache

# Generate key
RUN cp .env.example .env
RUN php artisan key:generate

# Run laravel optimization
RUN php artisan optimize:clear
RUN php artisan optimize

EXPOSE 80

CMD ["supervisord", "-c", "/etc/supervisor.d/supervisord.ini"]