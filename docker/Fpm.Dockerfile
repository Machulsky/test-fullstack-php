FROM php:7.4-fpm-alpine

RUN apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        curl-dev \
        imagemagick-dev \
        libtool \
        libxml2-dev \
        postgresql-dev \
        oniguruma-dev \
    && apk add --no-cache \
        curl \
        git \
        imagemagick \
        postgresql-libs \
        libintl \
        icu \
        icu-dev \
        libzip-dev \
    && pecl install imagick \
    && pecl install redis \
    && docker-php-ext-enable imagick \
    && docker-php-ext-enable redis \
    && docker-php-ext-install \
        bcmath \
        curl \
        iconv \
        mbstring \
        pdo \
        pdo_pgsql \
        pdo_mysql \
        pcntl \
        tokenizer \
        xml \
        zip \
        intl \
    && curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer \
    && apk del -f .build-deps
WORKDIR /var/www/



RUN addgroup -g 2200 www
RUN adduser -u 2200 -G www www -D

COPY --chown=www:www . /var/www/
# RUN chmod -R 777 /var/www/logs

RUN php database/migrate.php
USER www