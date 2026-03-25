# docker

1. Apache (httpd)
Serves content from ./html

Uses a custom httpd.conf

Logs mapped to ./logs

Depends on PHP-FPM

2. PHP-FPM (php:8.2-fpm)
Shares the same ./html directory

No custom config yet

## to check logs
docker logs apache_server

## using git bash
winpty docker exec -it apache_server ls -l /usr/local/apache2/logs
