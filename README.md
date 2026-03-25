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

