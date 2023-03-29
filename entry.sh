#!/bin/bash

set -e

php artisan migrate --force
php artisan db:seed

php-fpm8.0 -D -R
nginx -g 'daemon off;'
