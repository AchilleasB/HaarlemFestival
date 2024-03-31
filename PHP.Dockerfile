FROM php:fpm

RUN docker-php-ext-install pdo pdo_mysql

RUN apt-get update -y && apt-get install -y zlib1g-dev libpng-dev libfreetype6-dev

RUN docker-php-ext-configure gd --enable-gd --with-freetype

RUN docker-php-ext-install gd

RUN echo "upload_max_filesize = 20M" > /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size = 20M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "memory_limit = 256M" >> /usr/local/etc/php/conf.d/uploads.ini


# RUN pecl install xdebug && docker-php-ext-enable xdebug