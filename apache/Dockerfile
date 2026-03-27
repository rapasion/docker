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
COPY ssl/server.crt /usr/local/apache2/conf/ssl/
COPY ssl/server.key /usr/local/apache2/conf/ssl/
