FROM php:8.2-fpm

# ------------------------------------------------------------
# System dependencies
# ------------------------------------------------------------
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo \
        pdo_pgsql \
        pgsql \
        intl \
        zip \
        gd

# ------------------------------------------------------------
# Opcache (production settings)
# ------------------------------------------------------------
RUN docker-php-ext-install opcache

# Add recommended opcache settings
COPY opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# ------------------------------------------------------------
# PHP.ini overrides (production)
# ------------------------------------------------------------
COPY php.ini /usr/local/etc/php/conf.d/custom.ini

# ------------------------------------------------------------
# Healthcheck
# ------------------------------------------------------------
HEALTHCHECK --interval=30s --timeout=5s --retries=3 \
    CMD php -v > /dev/null || exit 1
