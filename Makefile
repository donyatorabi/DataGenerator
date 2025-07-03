APP_NAME=laravel_app

up:
	docker compose up -d --build

down:
	docker compose down

install:
	docker exec -it $(APP_NAME) composer install
	docker exec -it $(APP_NAME) npm install
	docker exec -it $(APP_NAME) npm run build

migrate:
	docker exec -it $(APP_NAME) php artisan migrate

bash:
	docker exec -it $(APP_NAME) bash

test:
	docker exec -it $(APP_NAME) php artisan test
