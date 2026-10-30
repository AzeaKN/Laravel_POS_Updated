#!/bin/sh
set -eu

if [ ! -f database/database.sqlite ]; then
    touch database/database.sqlite
fi

php artisan migrate --seed --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

exec apache2-foreground
