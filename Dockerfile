FROM php:8.2-fpm

# System deps
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libonig-dev libxml2-dev zip curl \
 && rm -rf /var/lib/apt/lists/*

# PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring bcmath gd

# Workdir
WORKDIR /var/www/html

# Copy app
COPY . .

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose Railway port (PHP built-in server)
EXPOSE 8080

# Start PHP built-in server (NO APACHE)
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
CMD php artisan key:generate --force || true && \
    php artisan migrate --force || true && \
    php artisan config:clear && \
    php artisan config:cache && \
    php -S 0.0.0.0:8080 -t public
    php artisan migrate --force && \
    php artisan db:seed --force && \
    php -S 0.0.0.0:8080 -t public

