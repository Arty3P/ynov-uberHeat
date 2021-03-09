PROJECT_NAME=UberHeat

app.init: docker.down docker.up app.composer.install app.db

app.permissions:
	docker-compose -p $(PROJECT_NAME) exec -uroot php chown -R www-data:www-data /app/var || true

app.cc: app.permissions
	docker-compose -p $(PROJECT_NAME) exec php bin/console c:c --no-warmup
	docker-compose -p $(PROJECT_NAME) exec php bin/console c:w

app.composer.install: app.permissions
	docker-compose -p $(PROJECT_NAME) exec php composer install

docker.up:
	docker-compose -p $(PROJECT_NAME) up -d --build;\

docker.run:
	docker-compose -p $(PROJECT_NAME) exec php $(command)

docker.down:
	docker-compose -p $(PROJECT_NAME) down -v

app.db:
	docker-compose -p $(PROJECT_NAME) exec php php bin/console doctrine:database:create
