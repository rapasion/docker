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

## tail logs
winpty docker exec -it apache_server tail -f //usr/local/apache2/logs/access_log

###################################################################################
Step 1: Install Docker Engine 
If Docker is not already installed, follow these steps using the official Docker Docs instructions:
Install required packages for yum-utils:
bash
sudo yum install -y yum-utils device-mapper-persistent-data lvm2
Add the official Docker repository:
bash
sudo yum-config-manager --add-repo https://download.docker.com/linux/centos/docker-ce.repo
Install Docker Engine and CLI:
bash
sudo yum install docker-ce docker-ce-cli containerd.io
Start and enable the Docker service:
bash
sudo systemctl start docker
sudo systemctl enable docker
(Optional) Add your user to the docker group to run commands without sudo (log out and log back in for this to take effect):
bash
sudo usermod -aG docker $(whoami)

########################################################################################
SSL
1. Create a folder for SSL certs
On your host:

Code
mkdir ssl
🧩 2. Generate a self‑signed certificate
Run this in PowerShell (not Git Bash):

powershell
openssl req -x509 -nodes -days 365 \
  -newkey rsa:2048 \
  -keyout ssl/server.key \
  -out ssl/server.crt \
  -subj "/CN=localhost"
This creates:

Code
ssl/server.key
ssl/server.crt
🧩 3. Update your docker-compose.yml
4. Update your Apache config (httpd.conf)
5. Restart your stack
docker compose down
docker compose up -d
https://localhost


### rebuild
4. Rebuild everything (critical)
You MUST rebuild the PHP image:

Code
docker compose down
docker compose build php
docker compose up -d

##validate compose file
docker compose config

## inspect 
docker inspect php_fpm --format='{{json .State.Health}}'
### module
docker exec -it php_fpm php -m

## docker exec
docker exec php_fpm php -m | grep pg

## adminer

Field	Value
System	PostgreSQL
Server	postgres
Username	richardp
Password	Password1!
Database	postgresdb

## PGAdmin
Inside pgAdmin:

Servers → Register → Server

Fill in:

General
Name: Postgres (Docker)

Connection
Field	Value
Hostname	postgres
Port	5432
Username	richardp
Password	Password1!
Maintenance DB	postgresdb
