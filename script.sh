#!/bin/bash

source .env

docker exec -w /var/www/html  phplaravel_monitor sed -i "s/ServerName \${VIRTUALHOST}/ServerName ${VIRTUALHOST}/" /etc/apache2/sites-available/virtualhost.conf

docker exec -w /var/www/html phplaravel_monitor composer install -vvv

docker exec -w /var/www/html phplaravel_monitor php artisan --version

docker exec -w /var/www/html  phplaravel_monitor cp .env.example .env

docker exec -w /var/www/html  phplaravel_monitor sed -i "s/APP_URL=http:\/\/localhost/APP_URL=http:\/\/$VIRTUALHOST/" .env

docker exec -w /var/www/html  phplaravel_monitor sed -i "s/DB_HOST=127.0.0.1/DB_HOST=postgresql_monitor/" .env

docker exec -w /var/www/html phplaravel_monitor php artisan key:generate

docker exec -w /var/www/html phplaravel_monitor rm -rf node_modules package-lock.json

docker exec -w /var/www/html phplaravel_monitor npm install

docker exec -w /var/www/html phplaravel_monitor php artisan migrate:fresh --seed

docker exec -w /var/www/html phplaravel_monitor chmod 777 -R storage

docker exec -w /var/www/html phplaravel_monitor php artisan storage:link

docker exec -w /var/www/html phplaravel_monitor php artisan optimize

docker exec -w /var/www/html phplaravel_monitor npm run dev

echo "Script execution completed successfully"

echo "http://$VIRTUALHOST:$HTTP_PORT"
