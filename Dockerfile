# Use the official PHP image as the base image
FROM php:latest

# Set the working directory in the container
WORKDIR /var/www/html

# Install required dependencies and extensions
RUN apt-get update \
    && apt-get install -y \
        git \
        zip \
        unzip \
        curl \
        libzip-dev \
    && docker-php-ext-install pdo_mysql zip

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the composer.json and composer.lock to leverage Docker cache
COPY composer.json composer.lock ./

# Copy the rest of the application code into the container
COPY . .

# Install project dependencies
RUN composer install --no-interaction --optimize-autoloader


# Generate the Laravel application key
RUN php artisan key:generate

# Set permissions for Laravel storage and bootstrap cache
RUN chgrp -R www-data storage bootstrap/cache \
    && chmod -R ug+rwx storage bootstrap/cache

# Expose port 80
EXPOSE 80

# Start the application
CMD php artisan serve --host=0.0.0.0 --port=80
