## Docker
production‑ready Apache image

1. Apache Dockerfile (apache/Dockerfile)
Dockerfile
FROM httpd:2.4

# Enable required modules
RUN sed -i \
    -e 's/#LoadModule ssl_module/LoadModule ssl_module/' \
    -e 's/#LoadModule socache_shmcb_module/LoadModule socache_shmcb_module/' \
    -e 's/#LoadModule proxy_module/LoadModule proxy_module/' \
    -e 's/#LoadModule proxy_fcgi_module/LoadModule proxy_fcgi_module/' \
    -e 's/#LoadModule headers_module/LoadModule headers_module/' \
    -e 's/#LoadModule rewrite_module/LoadModule rewrite_module/' \
    conf/httpd.conf

# Copy vhost config
COPY vhost.conf /usr/local/apache2/conf/extra/vhost.conf

# Include vhost in main config
RUN echo "Include conf/extra/vhost.conf" >> /usr/local/apache2/conf/httpd.conf

# Create directory for SSL certs
RUN mkdir -p /usr/local/apache2/conf/ssl
COPY ssl/server.crt /usr/local/apache2/conf/ssl/server.crt
COPY ssl/server.key /usr/local/apache2/conf/ssl/server.key
2. Virtual host with SSL + security headers (apache/vhost.conf)
apache
# Redirect HTTP → HTTPS
<VirtualHost *:80>
    ServerName localhost

    RewriteEngine On
    RewriteRule ^/(.*)$ https://%{HTTP_HOST}/$1 [R=301,L]
</VirtualHost>

# HTTPS vhost
<VirtualHost *:443>
    ServerName localhost

    SSLEngine on
    SSLCertificateFile "/usr/local/apache2/conf/ssl/server.crt"
    SSLCertificateKeyFile "/usr/local/apache2/conf/ssl/server.key"

    # Security headers
    Header always set X-Frame-Options "SAMEORIGIN"
    Header always set X-Content-Type-Options "nosniff"
    Header always set Referrer-Policy "strict-origin-when-cross-origin"
    Header always set X-XSS-Protection "1; mode=block"
    Header always set Content-Security-Policy "default-src 'self'; img-src 'self' data:; style-src 'self' 'unsafe-inline'; script-src 'self'"

    # HSTS (enable once you're sure HTTPS is stable)
    # Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains; preload"

    # Proxy to PHP-FPM container
    ProxyPreserveHost On
    ProxyPassMatch "^/(.*\.php(/.*)?)$" "fcgi://php_fpm:9000/var/www/html/$1"

    DocumentRoot "/var/www/html"

    <Directory "/var/www/html">
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog  "/usr/local/apache2/logs/error.log"
    CustomLog "/usr/local/apache2/logs/access.log" combined
</VirtualHost>
3. Self‑signed SSL cert (dev/initial prod)
Generate once on your host (inside apache/ssl):

bash
mkdir -p apache/ssl
openssl req -x509 -nodes -days 365 \
  -newkey rsa:2048 \
  -keyout apache/ssl/server.key \
  -out apache/ssl/server.crt \
  -subj "/C=PH/ST=Rizal/L=Binangonan/O=RichardP/OU=Dev/CN=localhost"
4. Docker Compose service snippet
yaml
apache:
  build: ./apache
  container_name: apache
  ports:
    - "80:80"
    - "443:443"
  depends_on:
    - php
  networks:
    - appnet
  volumes:
    - ./html:/var/www/html:ro
PHP service stays as your existing php_fpm on the same appnet network.

## rebuild
docker compose build apache
docker compose up -d
