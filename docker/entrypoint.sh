#!/bin/bash
set -e

# Generate APP_KEY if empty
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Ensure database directory and sqlite database exist if using sqlite
if [ "$DB_CONNECTION" = "sqlite" ] || [ -z "$DB_CONNECTION" ]; then
    mkdir -p /var/www/html/database
    touch /var/www/html/database/database.sqlite
    chown -R www-data:www-data /var/www/html/database
    chmod -R 775 /var/www/html/database
fi

# Run migrations and seed
php artisan migrate --force --seed || true

# Cache configurations
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# Start Apache in foreground
exec apache2-foreground
