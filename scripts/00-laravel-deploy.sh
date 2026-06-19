#!/usr/bin/env bash
echo "Running composer"
composer global require hirak/prestissimo
composer install --no-dev --optimize-autoloader --working-dir=/var/www/html

echo "Building Frontend Assets..."
npm install && npm run build

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force