FROM php:8.2-fpm-alpine
RUN apk --update add wget \
    curl \
    git \
    grep \
    build-base \
    libmemcached-dev \
    libmcrypt-dev \
    libxml2-dev \
    imagemagick-dev \
    pcre-dev \
    libtool \
    make \
    autoconf \
    g++ \
    cyrus-sasl-dev \
    libgsasl-dev \
    supervisor \
    bash

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions; \
    install-php-extensions zip gd pdo_mysql memcached imagick mysqli

COPY config/supervisord-fpm.conf /etc/supervisord.conf

ENTRYPOINT ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisord.conf"]