FROM php:fpm

RUN docker-php-ext-install pdo pdo_mysql

RUN apt-get update -y && apt-get install -y zlib1g-dev libpng-dev libfreetype6-dev

RUN docker-php-ext-configure gd --enable-gd --with-freetype

RUN docker-php-ext-install gd

# Commented out Xdebug installation for simplicity, uncomment if needed
# RUN pecl install xdebug && docker-php-ext-enable xdebug

# Increase upload file sizes and post sizes
RUN { \
        echo 'upload_max_filesize = 20M'; \
        echo 'post_max_size = 25M'; \
    } > /usr/local/etc/php/conf.d/uploads.ini
