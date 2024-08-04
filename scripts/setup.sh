#!/bin/bash

# Actualizar y actualizar paquetes
sudo apt update && sudo apt upgrade -y

# Instalar Docker
curl -fsSL https://get.docker.com -o get-docker.sh
sh get-docker.sh

# Instalar Docker Compose
sudo apt-get install -y docker-compose

# Instalar Nginx
sudo apt-get install -y nginx

# Crear enlaces simbólicos para las configuraciones de Nginx
sudo ln -sf $(pwd)/nginx/nginx.conf /etc/nginx/nginx.conf

# Crear enlaces simbólicos para las configuraciones de los sitios
for conf in $(pwd)/nginx/sites-available/*; do
    sudo ln -sf $conf /etc/nginx/sites-available/$(basename $conf)
    sudo ln -sf /etc/nginx/sites-available/$(basename $conf) /etc/nginx/sites-enabled/$(basename $conf)
done

# Reiniciar Nginx
sudo systemctl restart nginx

# Levantar servicios Docker
for dir in docker-compose/*; do
    if [ -d "$dir" ]; then
        docker-compose -f $dir/docker-compose.yml up -d
    fi
done
