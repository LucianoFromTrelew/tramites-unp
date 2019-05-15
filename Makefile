all: 
	npm --prefix client/app run start & docker-compose up --build

build:
	npm --prefix client/app run build && docker-compose up --build -d

clean:
	docker-compose down && pkill node

deletevolume:
	docker volume rm $(basename $PWD)_mariadb

fullclean: clean deletevolume
