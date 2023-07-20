#!/bin/sh

composer install
php artisan migrate --no-interaction
php artisan db:seed --no-interaction

php-fpm
