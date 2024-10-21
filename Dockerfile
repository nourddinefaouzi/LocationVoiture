## Base image
#FROM php:8.0-fpm
#
## Set working directory
#WORKDIR /var/www/html
#
## Install system dependencies
#RUN apt-get update && apt-get install -y \
#    libfreetype6-dev \
#    libjpeg62-turbo-dev \
#    libpng-dev \
#    libzip-dev \
#    libonig-dev \
#    zip \
#    unzip \
#    git \
#    curl \
#    libxml2-dev \
#    libjpeg-dev \
#    libfreetype6-dev \
#    libmcrypt-dev \
#    pkg-config
#
## Install PHP extensions
#RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
#    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip
#
## Install composer
#COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer
#
## Copy the application code into the container
#COPY . /var/www/html
#
## Set appropriate permissions
#RUN chown -R www-data:www-data /var/www/html
#
## Expose port 9000 and start PHP-FPM server
#EXPOSE 9000
#CMD ["php-fpm"]


FROM richarvey/nginx-php-fpm:1.7.2
COPY . .
# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1
# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr
# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1
CMD ["/start.sh"]