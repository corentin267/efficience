# build options
# install project
install:
	docker-compose exec php composer install

# docker-compose command helpers
.PHONY: up
# up containers
up:
	docker-compose up -d

# command to config db
.PHONY: db
db:
	docker-compose exec php bin/console doctrine:database:create --if-not-exists
	docker-compose exec php bin/console doctrine:migrations:migrate
	docker-compose exec php bin/console doctrine:fixtures:load

.PHONY: start
start: up install db