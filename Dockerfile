
FROM php:8.3-fpm
 
# Extensions necessàries per Laravel + MySQL
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd
 
# Node.js 20
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs
 
# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
 
WORKDIR /var/www
 
COPY . .
 
RUN composer install --no-interaction --prefer-dist --optimize-autoloader
 
RUN cp .env.example .env && php artisan key:generate --no-interaction
 
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
 
EXPOSE 9000
 
CMD ["php-fpm"]