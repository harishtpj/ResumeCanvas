FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git curl libpng-dev libzip-dev libonig-dev libxml2-dev libpq-dev zip unzip nginx \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

WORKDIR /var/www
COPY . .

RUN composer install --no-dev --optimize-autoloader \
    && npm install \
    && npm run build

COPY docker/nginx.conf /etc/nginx/sites-available/default

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 8080
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]