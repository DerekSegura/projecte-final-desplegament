#!/bin/bash

echo "==> Esperant que la base de dades estigui llesta..."
until docker exec laravel_db mysqladmin ping -h "localhost" --silent; do
  echo "   MySQL encara no està llest, esperant..."
  sleep 2
done
echo "   MySQL llest!"

echo "==> Executant migracions..."
docker exec laravel_app php artisan migrate --force

echo "==> Optimitzant..."
docker exec laravel_app php artisan config:cache

echo ""
echo "Llest! Accedeix a: http://localhost:8000"