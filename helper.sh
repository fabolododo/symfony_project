#!/bin/bash
help="
----------------
Help
----------------
  $0 COMMAND
----------------  

Available commands:
  start                                 Démarrer l'api
"

function start
{
    if [ ! -f .env ]; then
         install
    fi
    [ ! -z $(docker images -q symfony_project/php7.4) ] || docker build -t symfony_project/node .docker/node/ -t symfony_project/php7.4 .docker/php7.4/
    echo "Démarrage du projet..."
    docker-compose up
}


function install
{    
    echo "Installation du projet"
    cp .env.dist .env


    [ ! -z $(docker images -q symfony_project/php7.4) ] || docker build -t symfony_project/node .docker/node/ -t symfony_project/php7.4 .docker/php7.4/ 
    
    docker-compose up -d

    docker-compose exec php composer install
    docker-compose exec php php bin/console d:d:c
    docker-compose exec php php bin/console d:s:u --force
    docker-compose exec php mkdir var/cache
    docker-compose exec php mkdir var/logs
    docker-compose exec php chown -R www-data:www-data public
    docker-compose exec php chown -R www-data:www-data var/cache var/logs
}

function reset_cache
{
    docker-compose exec php rm -rf var/cache/*
    docker-compose exec php rm -rf var/logs/*
    docker-compose exec php chown -R www-data:www-data var/cache/
    docker-compose exec php chown -R www-data:www-data var/logs/
}

function clear_cache
{
    docker-compose exec php php bin/console cache:clear
}


function stop
{
       docker-compose stop
}


if [ $# == 0 ] ; then
    echo "$help"
    exit 1;
fi

if [[ $1 == "install" ]]; then
    install
fi

if [[ $1 == "resetCache" ]]; then
    reset_cache
fi

if [[ $1 == "start" ]]; then
    start
fi

if [[ $1 == "stop" ]]; then
    stop
fi

if [[ $1 == "args" ]]; then
    echo $1
    touch $2
fi

if [[ $1 == "restart" ]]; then
    docker-compose down &&  docker-compose up -d
fi