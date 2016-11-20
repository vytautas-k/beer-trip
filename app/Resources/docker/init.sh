#!/bin/bash

echo "[info] copy default parameters.yml"
cp -n /var/www/app/config/parameters.yml.dist /var/www/app/config/parameters.yml

echo "[info] Running composer"
composer install --optimize-autoloader --working-dir=/var/www

echo "[info] Changing permissions for storage/"
chmod -R 777 /var/www/app/cache /var/www/app/logs /var/www/app/session

echo "[info] Waiting for mysql"
sleep 10

echo "[info] Migrating database"
php /var/www/app/console cache:clear
php /var/www/app/console doctrine:schema:update --force

chown -R www:www /var/www
