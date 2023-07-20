FROM php:8.1.3-fpm-alpine3.15

# install necessary alpine packages
RUN apk update && apk add --no-cache \
    zip \
    unzip \
    dos2unix \
    supervisor \
    libpng-dev \
    libzip-dev \
    freetype-dev \
    $PHPIZE_DEPS \
    libjpeg-turbo-dev \
    npm

# compile native PHP packages
RUN docker-php-ext-install \
    gd \
    pcntl \
    bcmath \
    mysqli \
    pdo_mysql

# configure packages
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# install additional packages from PECL
RUN pecl install zip && docker-php-ext-enable zip \
    && pecl install igbinary && docker-php-ext-enable igbinary \
    && yes | pecl install redis && docker-php-ext-enable redis

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY ./docker-config/php/start-container.sh /usr/local/bin/start-container.sh
COPY ./docker-config/php/php.ini /usr/local/etc/php/conf.d/app.ini
RUN chmod +x /usr/local/bin/start-container.sh

EXPOSE 9000

ENTRYPOINT ["start-container.sh"]
