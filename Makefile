php := server
docker := docker-compose
compose := $(docker) --file docker-compose.yml --file docker-compose.override.yml
docker_exec := $(compose) exec
args = $(filter-out $@,$(MAKECMDGOALS))

test_dot:
	$(docker_exec) $(php) bash -c "./bin/phpunit --color"

test:
	$(docker_exec) $(php) bash -c "./bin/phpunit --testdox --color --stop-on-failure"

up:
	$(docker) up -d

bash:
	$(docker_exec) $(php) bash

install:
	$(docker_exec) $(php) bash -c "composer install"

run:
	$(docker_exec) $(php) bash -c "php ./public/index.php"

coverage:
	$(docker_exec) $(php) bash -c "php -dxdebug.mode=coverage ./bin/phpunit --testdox --color --coverage-html coverage"
.PHONY: coverage

stop:
	$(docker) stop

rm:
	$(docker) rm $(php) --force

build:
	$(docker) up -d --build

rebuild: stop rm build

composer:
	$(docker_exec) $(php) composer $(args)
