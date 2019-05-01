all: 
	docker-compose up --build

clean:
	docker-compose down

deletevolume:
	docker volume rm $(basename $PWD)_mariadb

fullclean: clean deletevolume
