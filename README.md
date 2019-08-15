# Clean Architecture in PHP Symfony

An example project following clean architecture principles in Symfony

Setup instructions
==================
1. create a .env file
```
cp .env.dist .env
```

2. create containers
```
make start
```


3. build php app
	- install vendor packages
	- check style/mess detector
	- run unit tests

```
make build-php-app php
```

4. restart php container
```
make restart php
```

Hosts
=====
Service
 - URL: http://localhost:8021/ 

Documentation
=============
- README.md
- docs/architecture_overview.pdf
- Swagger/OpenAPI
	- json: http://localhost:8021/api/docs.json
	- swagger ui: http://localhost:8021/docs/
