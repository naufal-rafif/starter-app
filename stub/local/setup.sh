CONTAINER_NAME=$(grep ^CONTAINER_NAME= .env | cut -d '=' -f2 | tr -d '"')
sed -i "s/^DB_HOST=.*/DB_HOST=$CONTAINER_NAME-pgsql/" .env

CONTAINER_NAME=${CONTAINER_NAME:-starter-project}

docker compose down
sh stub/bash/clearlog.sh
cp stub/local/rr rr
cp stub/local/.rr.yaml .rr.yaml
docker compose up -d --build

docker exec $CONTAINER_NAME composer install

docker exec $CONTAINER_NAME chmod -R ugo+rw vendor/
docker exec $CONTAINER_NAME chmod -R ugo+rw bootstrap/cache/
docker exec $CONTAINER_NAME chmod -R ugo+rw storage/

docker exec $CONTAINER_NAME chmod ugo+rw composer.lock
docker exec $CONTAINER_NAME chmod ugo+rw composer.json

docker exec $CONTAINER_NAME php artisan migrate --seed
docker exec $CONTAINER_NAME npm install chokidar

docker exec $CONTAINER_NAME chmod +x ./rr
docker exec $CONTAINER_NAME chmod ugo+rw ./.rr.yaml