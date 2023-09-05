start:
	docker-compose up -d
build:
	docker-compose up -d --build

stop:
	docker-compose down

api1:
	docker exec -it api_piranha bash
db1:
	docker exec -it db_piranha bash

client1:
	docker exec -it client_piranha sh