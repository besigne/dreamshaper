#!/bin/sh
# entrypoint.sh

docker exec dreamshaper-backend php artisan cache:clear
docker exec dreamshaper-backend php artisan config:clear
docker exec dreamshaper-backend php artisan migrate:reset
docker exec dreamshaper-backend php artisan migrate
docker exec dreamshaper-backend  php artisan db:seed
