# parse target arguments
TARGET_ARGS := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))
$(eval $(TARGET_ARGS):;@:)

-include .env

help:           ## Show this help, Assumption there is an app container called 'web'
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//'

# containers

start:          ## start the application
	docker-compose up -d

stop:           ## stop the application
	docker-compose stop

rebuild:        ## build a container (e.g. make rebuild web)
	docker-compose build --force-rm $(TARGET_ARGS)

restart:        ## restart a container
	docker-compose stop $(TARGET_ARGS) && docker-compose start $(TARGET_ARGS)

clean-restart:  ## stop, remove, start
	docker-compose stop $(TARGET_ARGS) && docker-compose rm -f $(TARGET_ARGS) && make rebuild $(TARGET_ARGS) && make start

logs:           ## tail container logs
	docker-compose logs -f $(TARGET_ARGS)

bash:           ## open a container's bash
	docker-compose exec $(TARGET_ARGS) sh



build-php-app:  ## builds a php app (make build-php-app myServiceName)
	docker-compose exec $(TARGET_ARGS) /bin/bash -c "./composer.phar install"
	docker-compose exec $(TARGET_ARGS) /bin/bash -c "make build"
