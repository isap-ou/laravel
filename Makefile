TARGET := .env
SOURCE := .env.example

include .env.example
export

COLOUR_GREEN=\033[0;32m
COLOUR_RED=\033[0;31m
COLOUR_BLUE=\033[0;34m
COLOUR_END=\033[0m

init: copy-env
	$(MAKE) build
	$(MAKE) start
	$(MAKE) composer install
	$(MAKE) yarn install
	$(MAKE) migrate

copy-env:
	@if [ ! -f $(TARGET) ]; then \
		cp $(SOURCE) $(TARGET); \
		echo "$(TARGET) was copied."; \
	else \
		echo "$(TARGET) already exists."; \
	fi

build:
	@echo  "$(COLOUR_GREEN)Building containers$(COLOUR_END)"
	docker-compose build --no-cache

start:
	@echo  "$(COLOUR_GREEN)Starting containers$(COLOUR_END)"
	docker-compose up -d

stop:
	@echo  "$(COLOUR_GREEN)Stopping containers$(COLOUR_END)"
	docker-compose down --remove-orphans

composer:
	docker-compose exec laravel.test composer $(filter-out $@,$(MAKECMDGOALS))

yarn:
	docker-compose exec laravel.test yarn $(filter-out $@,$(MAKECMDGOALS))

migrate:
	docker-compose exec laravel.test php artisan migrate

pint:
	docker-compose exec laravel.test vendor/bin/pint

shell:
	docker-compose exec laravel.test bash

artisan:
	docker-compose exec laravel.test php artisan $(filter-out $@,$(MAKECMDGOALS))

# Magic to accept additional arguments from the command line
%:
	@:

.PHONY: init pint migrate yarn composer stop start build copy-env artisan