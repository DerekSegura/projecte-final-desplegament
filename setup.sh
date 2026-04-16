#!/bin/bash

echo "==> Aturant i netejant contenidors antics..."
docker compose down -v

echo "==> Construint i aixecant contenidors..."
docker compose up -d --build

echo "==> Instal·lant vendor (composer)..."
docker exec laravel_app composer install --no-interaction --prefer-dist --optimize-autoloader

echo "==> Copiant .env..."
docker exec laravel_app cp .env.example .env

echo "==> Generant APP_KEY..."
docker exec laravel_app php artisan key:generate

echo "==> Esperant que la base de dades estigui llesta..."
until docker exec laravel_db mysqladmin ping -h "localhost" --silent; do
  echo "   MySQL encara no està llest, esperant..."
  sleep 2
done
echo "   MySQL llest!"

echo "==> Executant migracions..."
docker exec laravel_app php artisan migrate --force

echo "==> Compilant assets (npm)..."
docker exec laravel_app npm install
docker exec laravel_app npm run build

echo "==> Arreglant permisos..."
docker exec -u root laravel_app chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

echo "==> Optimitzant..."
docker exec laravel_app php artisan config:cache

echo ""
echo "Llest! Accedeix a: http://localhost:8000"