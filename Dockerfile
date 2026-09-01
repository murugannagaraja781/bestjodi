FROM php:7.4-apache

# Set maintainer & labels
LABEL maintainer="BestJodi DevOps"
LABEL description="Production Docker Image for BestJodi Matrimonial Portal"

# Install system dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libwebp-dev \
    libxpm-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    zip \
    unzip \
    curl \
    mariadb-client \
    && rm -rf /var/lib/apt/lists/*

# Configure & install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
        gd \
        mysqli \
        pdo_mysql \
        mbstring \
        zip \
        opcache \
        exif \
        bcmath \
        xml

# Enable Apache modules
RUN a2enmod rewrite headers expires deflate

# Copy custom PHP configuration
COPY config/php.ini /usr/local/etc/php/conf.d/custom.ini

# Set working directory to webroot
WORKDIR /var/www/html

# Copy application source code
COPY public_html/ /var/www/html/

# Set proper ownership and permissions
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \; \
    && chmod -R 775 /var/www/html/my_photos \
    && chmod -R 775 /var/www/html/my_photos_big \
    && chmod -R 775 /var/www/html/horoscope-list \
    && chmod -R 775 /var/www/html/SuccessStory \
    && chmod -R 775 /var/www/html/advertise \
    && chmod -R 775 /var/www/html/img \
    && chmod -R 775 /var/www/html/chat || true

# Healthcheck
HEALTHCHECK --interval=30s --timeout=5s --start-period=10s --retries=3 \
    CMD curl -f http://localhost/ || exit 1

EXPOSE 80

CMD ["apache2-foreground"]
