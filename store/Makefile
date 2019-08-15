# build

install-dependencies: ## install php dependencies
	./composer.phar install --no-suggest --prefer-dist;
	./composer.phar validate --no-check-publish --strict

check-style: ## run style checks
	./vendor/bin/phpcs --config-set ignore_warnings_on_exit 1
	./vendor/bin/phpcs --colors --standard=PSR2 src tests

check-mess: ## Run mess detector
	./vendor/bin/phpmd src text ./phpmd.xml

test: ## Run unit tests
	./vendor/bin/phpunit

test-coverage: ## Run travis test suite (not tested)
	./vendor/bin/phpunit --coverage-clover build/logs/clover.xml

build:
	$(MAKE) check-style
	$(MAKE) check-mess
	$(MAKE) test
