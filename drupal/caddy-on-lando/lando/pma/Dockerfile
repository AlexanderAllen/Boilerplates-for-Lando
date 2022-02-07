FROM caddy:2.4.6-alpine

RUN apk update \
    && apk add busybox-extras curl

COPY --from=phpmyadmin:5-fpm-alpine /var/www/html /var/www/html
