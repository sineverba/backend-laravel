build:
	docker build --tag registry.heroku.com/backend-laravel/web --build-arg APP_VERSION=0.4.1 --file docker/app/Dockerfile "."

test:
	docker run -d --name imagetest -e "PORT=9876" -p 9876:9876 registry.heroku.com/backend-laravel/web
	docker exec -it imagetest php -i | grep "PHP Version => 8.0.3"
	docker container stop imagetest
	docker container rm imagetest

deploy:
	heroku config:set APP_VERSION=0.4.1 -a backend-laravel
	docker push registry.heroku.com/backend-laravel/web
	heroku container:release web -a backend-laravel
	heroku run php /var/www/artisan migrate --force --app backend-laravel
	heroku labs:enable --app=backend-laravel runtime-new-layer-extract
	#heroku run php /var/www/artisan l5-swagger:generate --app backend-laravel

destroy:
	docker image rm registry.heroku.com/backend-laravel/web

swagger:
	docker-compose exec app php artisan l5-swagger:generate
