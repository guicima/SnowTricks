# SnowTricks
Collaborative site to make snowboarding known to the general public and help in learning tricks.

## Set up the environnement
**Install dependencies**

Install Docker
[Get Docker](https://docs.docker.com/get-docker/)

Install Composer
[Get Composer](https://getcomposer.org/)

**Start the project**

Navigate to app directory
```sh
cd .\app\
```

Install composer dependencies
```sh
composer install
```
```sh
npm install
```

Start containers
```sh
docker-compose up
```
or
```sh
docker-compose up -d
```
to run in detached mode.

Start project in local
```sh
symfony serve
```

**Access the project**

|Container| Folder | Address |
|--|--|:--:|
| MailCatcher  | none  | [http://localhost:1080/](http://localhost:1080/) |
| PostgreSQL | ``./docker/db/data`` | [http://localhost:5432/](http://localhost:5432/) |
| pgAdmin | none | [http://localhost:5050/](http://localhost:5050/) |