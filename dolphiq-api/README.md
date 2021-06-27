# <p align="center"><a href="https://documenter.getpostman.com/view/1759694/TzeZESKq#f2b81d01-8adf-4fe9-9038-e00d9e0c3c39" target="_blank"> Dolphiq CRM - REST API </a></p>

## About API

The Dolphiq CRM REST API is the mmain interface for CRM dashboard and mobile app. The API developed using Laravel framework. If need to know more about [Laravel](https://laravel.com), read their official [documentation](https://laravel.com/docs)


## Installation

Follow step by step guide to locally setup the aplication


#### 1.Install Docker and Docker compose on local machine

Read the official Docker [documentation](https://docs.docker.com/engine/install/ubuntu/)


#### 2.Go to API project path

```sh
cd dolphiq-assessment/dolphiq-api
```

#### 3.Setup environment

Just only need to run:

```sh
docker-compose up -d
```

#### 4. Update project dependencies

```sh
make composer-update
```
*** Refer 'Makefile' file in root for all the configured commands

#### 5. Set .env values

```sh
cp .env.example .env
```

  ##### DB

```sh
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=<DB NAME>                           // Create a Database and put its name here
DB_CONNECTION_TEST=<DB NAME FOR UNIT TEST>      // Create a Database for testing and put its name here
DB_USERNAME=root 
DB_PASSWORD=123456
```

  ###### Sentry

```sh
SENTRY_LARAVEL_DSN=<SENTRY URL>
```

#### 6. Generate application key

```sh
make key
```

#### 7. Give proper permissions

```sh
make perm
```

#### 8. DB Migrate

```sh
make db-migrate
```

#### 9. DB Seeds

```sh
make db-seed
```

#### 10. Passport Install

```sh
make passport-install
```
** Copy "Client ID" and "Client Secret" under "Password grant client created successfully" message in terminal. These keys need to add front end env to connect with the API


#### 11. Start Queue

```sh
make queue-start
```

#### 12. Consume API using:

```sh
http:localhost:8100
```


## API Documentation

Read the API [documentation](https://documenter.getpostman.com/view/1759694/TzeZESKq#f2b81d01-8adf-4fe9-9038-e00d9e0c3c39).
