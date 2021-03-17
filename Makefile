build:
	docker build --tag registry.heroku.com/backend-laravel/web --file docker/app/Dockerfile "."

test:
	docker run -d --name imagetest -e "PORT=9876" -p 9876:9876 registry.heroku.com/backend-laravel/web
	docker exec -it imagetest php -i | grep "PHP Version => 8.0.3"
	docker container stop imagetest
	docker container rm imagetest

deploy:
	docker push registry.heroku.com/backend-laravel/web
	heroku container:release web -a backend-laravel
	heroku run php /var/www/artisan migrate --force --app backend-laravel
	heroku labs:enable --app=backend-laravel runtime-new-layer-extract

destroy:
	docker image rm registry.heroku.com/backend-laravel/web
