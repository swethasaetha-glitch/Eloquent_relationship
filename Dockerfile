FROM php:8.2-apache

# Install required system packages
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libsqlite3-dev \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions required by Laravel
RUN docker-php-ext-install pdo pdo_mysql pdo_sqlite bcmath mbstring gd

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Configure Apache virtual host
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Set Composer environment
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install production dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Create SQLite database file as default fallback
RUN mkdir -p database && touch database/database.sqlite

# Set proper ownership and permissions
RUN chown -R www-data:www-data storage bootstrap/cache database \
    && chmod -R 775 storage bootstrap/cache database

# Setup entrypoint script
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
