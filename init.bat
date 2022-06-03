@echo off

echo ----------------- Stop and remove containers -----------------

FOR /F %%d IN ('docker stop mello-nginx') DO (docker rm %%d)
FOR /F %%d IN ('docker stop mello-php') DO (docker rm %%d)
FOR /F %%d IN ('docker stop mello-db') DO (docker rm %%d)

echo ------------------------ Build docker ------------------------

docker-compose up -d

echo ---------------------- Composer install ----------------------

docker exec -u root -i -w /var/www/html/ mello-php composer install --prefer-source --no-interaction

echo -------------- laravel deploy -----------------

docker exec -i -w /var/www/html/ mello-php chmod -R ugo+rw storage --prefer-source --no-interaction
docker exec -i -w /var/www/html/ mello-php php artisan make:migration --seed --prefer-source --no-interaction