## Set up project

### With docker-compose, 
```
docker-compose up -d
docekr-compose exec backend bash
composer install
php bin/console doctrine:migrations:migrate
php bin/console cache:clear
```
review project settings on .env

your application should be running on http://localhost:8080

### Without docker-compose:
 - requirements
   - php 8.1
   - postgres 14
   - php composer
   - webserver
 - update postgres connection details on .env 

## App usage

### Creating a Post

```
curl --location --request POST 'http://localhost:8080/posts' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "title": "My first post",
    "summary": "Nam non est risus. Donec at orci at lectus consequat scelerisque vel ac justo."
}'
```
