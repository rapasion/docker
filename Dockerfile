# Use official Apache HTTP Server image as base
FROM httpd:2.4

# Set maintainer (optional)
LABEL maintainer="your-name@example.com"

# Copy your website files into the Apache document root
# Make sure you have an 'html' folder next to this Dockerfile
COPY ./html/ /usr/local/apache2/htdocs/

# Expose HTTP port
EXPOSE 80

# Apache is started by default via the base image's CMD

#postgresdb
#FROM php:8.2-fpm

#RUN apt-get update && apt-get install -y \
#    libpq-dev \
#    && docker-php-ext-install pdo pdo_pgsql pgsql
