FROM nginx:alpine

RUN apk --update add supervisor bash

RUN adduser -u 1000 -D -S -G www-data www-data

RUN rm /var/cache/apk/*

COPY config/nginx.conf /etc/nginx/nginx.conf
COPY config/laravel.conf /etc/nginx/http.d/default.conf
COPY config/supervisord-nginx.conf /etc/supervisord.conf

ENTRYPOINT ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisord.conf"]