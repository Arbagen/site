## Requirements:
* docker
* docker-compose
* git

## Services:
1. nginx
2. mysql
3. pma
4. php (contains installed git and composer)

## Configs:
All configs/logs/data for each service in appropriate service folder.

## Application files:
All application files folder contains in public_html

## Links:
* web-server: [http://localhost:8080/](http://localhost:8080/)
* PMA: [http://localhost:8081/](http://localhost:8081/)

#Instaling
## docker prepare
```bash
apt update
apt install curl git mc
curl -fsSL get.docker.com -o get-docker.sh
sh get-docker.sh
curl -L https://github.com/docker/compose/releases/download/1.19.0/docker-compose-`uname -s`-uname -m -o /usr/local/bin/docker-compose
chmod +x /usr/local/bin/docker-compose
```

## RUN:
```bash
docker-compose up -d
```

## prepare libs
```bash
docker-compose exec php bash
composer install
yarn install
./bin/console doctrine:schema:create
yarn run encore
```