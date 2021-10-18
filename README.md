# Symfony Crypto Portfolio API

### Prerequisites
* [Docker](https://www.docker.com/)

### Container
 - [php-fpm](https://hub.docker.com/_/php) 7.4.+
    - [composer](https://getcomposer.org/) 
    - [yarn](https://yarnpkg.com/lang/en/) and [node.js](https://nodejs.org/en/) (if you will use [Encore](https://symfony.com/doc/current/frontend/encore/installation.html) for managing JS and CSS)
 - [nginx](https://hub.docker.com/_/nginx) 1.21.+
 - [mysql](https://hub.docker.com/_/mysql/) 5.7.+

### Installing

run docker and connect to container:
```
 docker compose up --build
```
```
 docker compose exec php sh
```
install composer packages:
```
# run composer install command: 
composer install
```

modify your DATABASE_URL config in .env 
```
DATABASE_URL=mysql://root:root@mysql:3306/symfony?serverVersion=5.7
```

## Ready up use
See API documentation [HERE](https://app.swaggerhub.com/apis/semicolon48/crypto-protfolio-api/0.0.1).