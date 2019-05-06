all: 
	npm --prefix client/app run dev & docker-compose up --build

clean:
	docker-compose down && pkill node

deletevolume:
	docker volume rm $(basename $PWD)_mariadb

fullclean: clean deletevolume
