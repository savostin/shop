#!/bin/sh

cd /var/www

php artisan migrate:fresh
php artisan db:seed --class=ProductSeeder
php artisan db:seed --class=VariationSeeder

php artisan cache:clear
php artisan route:cache

php artisan serve --host=0.0.0.0 --port=80