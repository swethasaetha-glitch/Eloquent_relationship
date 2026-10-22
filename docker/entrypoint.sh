#!/bin/bash
set -e

# Ensure .env exists
if [ ! -f /var/www/html/.env ]; then
    cp /var/www/html/.env.example /var/www/html/.env
fi

# Set APP_KEY if provided in environment, or generate a fresh one
if [ -n "$APP_KEY" ]; then
    sed -i "s|^APP_KEY=.*|APP_KEY=$APP_KEY|" /var/www/html/.env
else
    php artisan key:generate --force
fi

# Ensure SQLite database exists and has proper permissions
mkdir -p /var/www/html/database
touch /var/www/html/database/database.sqlite

# Ensure storage and bootstrap permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database /var/www/html/.env
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
chmod 664 /var/www/html/.env

# Run database migrations and seed sample records
php artisan migrate --force --seed || true

# Cache Laravel configurations and routes for maximum performance
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# Adapt Apache to Render's dynamic PORT environment variable (default 80)
RENDER_PORT=${PORT:-80}
sed -i "s/Listen 80/Listen $RENDER_PORT/g" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost \*:$RENDER_PORT>/g" /etc/apache2/sites-available/000-default.conf

# Start Apache in the foreground
echo "Starting Apache on port $RENDER_PORT..."
exec apache2-foreground
