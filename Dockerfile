# Use the official PHP image with Apache
FROM php:7.4-apache

# Install necessary PHP extensions and other dependencies
RUN apt-get update && \
  apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev libzip-dev zip && \
  docker-php-ext-configure gd --with-freetype --with-jpeg && \
  docker-php-ext-install gd mysqli pdo_mysql zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy CakePHP application code to the container
COPY . /var/www/html

# Set permissions for the web server user
RUN chown -R www-data:www-data /var/www/html && \
  chmod -R 755 /var/www/html

# Install Composer
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

# Expose port 80 for the web server
EXPOSE 80
