#!/usr/bin/env bash
# Script de deploy pentru Infinity SRL
# Folosire: ssh user@server "cd /var/www/infinity && bash deploy/deploy.sh"

set -e

echo "==> Activez maintenance mode"
php artisan down --render="errors::503" --secret="bypass-secret-key" || true

echo "==> Pull latest code"
git pull origin main

echo "==> Install dependencies (no dev, optimized)"
composer install --no-dev --optimize-autoloader --no-interaction

echo "==> Run migrations"
php artisan migrate --force

echo "==> Build front-end assets"
npm ci --omit=dev
npm run build

echo "==> Cache config / routes / views"
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

echo "==> Set proper permissions"
chmod -R 755 storage bootstrap/cache
# Sau, pentru www-data:
# chown -R www-data:www-data storage bootstrap/cache

echo "==> Restart workers (dacă există)"
php artisan queue:restart || true

echo "==> Dezactivez maintenance mode"
php artisan up

echo "==> Deploy complet!"
echo ""
echo "Verifică: curl -I https://infinity.md/"
