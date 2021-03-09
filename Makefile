define echoc
    tput setaf 6;echo ">>> $(1)";tput sgr0
endef

PROJECT_NAME=UberHeat

app.init: docker.down docker.up app.composer.install app.db generate-keypair-prod

app.permissions:
	docker-compose -p $(PROJECT_NAME) exec -uroot php chown -R www-data:www-data /app/var || true

app.cc: app.permissions
	docker-compose -p $(PROJECT_NAME) exec php bin/console c:c --no-warmup
	docker-compose -p $(PROJECT_NAME) exec php bin/console c:w

app.composer.install: app.permissions
	docker-compose -p $(PROJECT_NAME) exec php composer install

docker.up:
	docker-compose -p $(PROJECT_NAME) -f docker-compose.yml -f docker-compose.development.yml up -d

docker.run:
	docker-compose -p $(PROJECT_NAME) exec php $(command)

docker.down:
	docker-compose -p $(PROJECT_NAME) down -v

app.db:
	docker-compose -p $(PROJECT_NAME) exec php php bin/console doctrine:database:create

generate-keypair-prod:
	docker-compose -p $(PROJECT_NAME) exec php php bin/console lexik:jwt:generate-keypair --skip-if-exists

generate-keypair-dev:
	docker-compose -p $(PROJECT_NAME) exec php php bin/console lexik:jwt:generate-keypair --skip-if-exists
