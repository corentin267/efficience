# build options
# install project
install: vendor/autoload.php

vendor/autoload.php:
	docker-compose exec php composer install

# docker-compose command helpers
.PHONY: up
# up containers
up:
	docker-compose up

# command to load fixtures
.PHONY: fixture
fixture:
	php bin/console doctrine:fixtures:load
