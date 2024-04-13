FROM php:8-fpm-alpine
RUN docker-php-ext-install pdo pdo_mysql
RUN apk add --no-cache $PHPIZE_DEPS \
    && apk add --update linux-headers \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug