#!/bin/sh
set -e

php artisan migrate:fresh --seed

# Iniciar PHP-FPM
exec php-fpm