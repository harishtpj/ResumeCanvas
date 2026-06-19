#!/bin/sh

# Set directory permissions for Laravel
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Run migrations and cache config
echo "Running migrations..."
php artisan migrate --force

echo "Caching configurations..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start Nginx
service nginx start

# Start PHP-FPM
php-fpm