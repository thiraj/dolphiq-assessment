#-----------------------------------------------------------
# Docker
#-----------------------------------------------------------

# Wake up docker containers
up:
	docker-compose up -d

# Shut down docker containers
down:
	docker-compose down

# Show a status of each container
status:
	docker-compose ps

# Show logs of each container
logs:
	docker-compose logs

# Restart all containers
restart: down up

# Build and up docker containers
build:
	docker-compose up -d --build

# Build containers with no cache option
build-no-cache:
	docker-compose build --no-cache

# Build and up docker containers
rebuild: down build

# Run terminal of the php container
php:
	docker-compose exec app bash

# Run terminal of the php container
supervisor:
	docker-compose exec supervisor bash



#-----------------------------------------------------------
# Database
#-----------------------------------------------------------

# Fresh all migrations
db-migrate-install:
	docker-compose exec app php artisan migrate:install

# Run database migrations
db-migrate:
	docker-compose exec app php artisan migrate

# Migrate alias
migrate: db-migrate

# Run migrations rollback
db-rollback:
	docker-compose exec app php artisan migrate:rollback

# Rollback alias
rollback: db-rollback

# Run seeders
db-seed:
	docker-compose exec app php artisan db:seed

# Fresh all migrations
db-fresh:
	docker-compose exec app php artisan migrate:fresh

# Dump database into file
db-dump:
	docker-compose exec postgres pg_dump -U app -d app > docker/postgres/dumps/dump.sql


#-----------------------------------------------------------
# Queue
#-----------------------------------------------------------

# Start queue process
queue-start:
	docker-compose exec app php artisan queue:work --tries=3

# Restart queue process
queue-restart:
	docker-compose exec app php artisan queue:restart

# Restart queue process
queue-down:
	docker-compose exec app php artisan queue:pause

# Restart queue process
supervisor-reread:
	docker-compose exec supervisor supervisorctl reread

# Restart queue process
supervisor-restart:
	docker-compose exec supervisor supervisorctl restart all


#-----------------------------------------------------------
# Testing
#-----------------------------------------------------------

# Run phpunit tests
test:
	docker-compose exec app vendor/bin/phpunit



#-----------------------------------------------------------
# Dependencies
#-----------------------------------------------------------

# Install composer dependencies
composer-install:
	docker-compose exec app composer install

# Install composer dependencies
composer-require:
	docker-compose exec app composer require

# Update composer dependencies
composer-update:
	docker-compose exec app composer update

# Passport install
passport-install:
	docker-compose exec app php artisan passport:install




#-----------------------------------------------------------
# Tinker
#-----------------------------------------------------------

# Run tinker
tinker:
	docker-compose exec php php artisan tinker


#-----------------------------------------------------------
# Installation
#-----------------------------------------------------------

# Copy the Laravel API environment file
env-app:
	cp .env.example .env


# Add permissions for Laravel cache and storage folders
permissions:
	sudo chmod -R 777 bootstrap/cache
	sudo chmod -R 777 storage

# Permissions alias
perm: permissions

# Generate a Laravel app key
key:
	docker-compose exec app php artisan key:generate --ansi

# Generate a Laravel storage symlink
storage:
	docker-compose exec app php artisan storage:link

# PHP composer autoload command
autoload:
	docker-compose exec app composer dump-autoload



#-----------------------------------------------------------
# Clearing
#-----------------------------------------------------------

# Shut down and remove all volumes
remove-volumes:
	docker-compose down --volumes

# Remove all existing networks (useful if network already exists with the same attributes)
prune-networks:
	docker network prune

# Clear cache
cache-clear:
    docker-compose exec app php artisan config:cache



