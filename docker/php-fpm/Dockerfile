# Use PHP-FPM 8.1 base image
FROM php:8.1-fpm-alpine
# Copy composer.lock and composer.json
COPY ./composer.json* /var/www/

# Set working directory
WORKDIR /var/www

ARG DEBIAN_FRONTEND=noninteractive

# Configure & Install Extension
RUN apk add --no-cache zip libzip-dev \
    && docker-php-ext-install \
      bcmath \
      pdo_mysql \
      zip

    # Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN addgroup -g 1000 -S www
RUN adduser -u 1000 -g www -S www

# Copy existing application directory contents
COPY ./ /var/www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
