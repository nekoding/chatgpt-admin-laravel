FROM php:8.2-fpm-alpine

WORKDIR /var/www/html/

# Essentials
# RUN echo "UTC+8" > /etc/timezone
RUN addgroup -S appkey && adduser -S appkey -G appkey
RUN apk update && apk upgrade && apk add --no-cache zip unzip curl sqlite nginx supervisor

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
# COPY .docker/config/nginx.conf /etc/nginx/
COPY .docker/config/laravel.conf /etc/nginx/sites-enabled/
RUN nginx -t

# RUN mkdir -p /run/nginx/
# RUN touch /run/nginx/nginx.pid

RUN ln -sf /dev/stdout /var/log/nginx/access.log
RUN ln -sf /dev/stderr /var/log/nginx/error.log

# Building process
COPY . .
RUN composer install --no-dev
RUN chown -R www-data:www-data /var/www/html/storage

EXPOSE 9000
CMD ["supervisord", "-c", "/etc/supervisor.d/supervisord.ini"]
