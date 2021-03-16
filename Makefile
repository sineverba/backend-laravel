build:
	docker build --tag backend-laravel-test --file docker/app/Dockerfile "."

test:
	docker run -d --name imagetest -e "PORT=9876" -p 9876:9876 backend-laravel-test
	docker exec -it imagetest php -i | grep "PHP Version => 8.0.3"
	docker container stop imagetest
	docker container rm imagetest

destroy:
	docker image rm backend-laravel-test
