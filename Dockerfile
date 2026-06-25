FROM php:8.2-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    sqlite3 \
    libsqlite3-dev

# Install PHP extensions
RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip pdo pdo_sqlite

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-interaction

EXPOSE 9000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=9000"]