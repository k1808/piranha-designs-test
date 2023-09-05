php8.1 & node 18
1. cd api
2. cp .env.example .env
3. cd ..
4. make start
5. make api1
6. composer install
7. php artisan key:generate
9. php artisan migrate
10. exit
11. make client1
12. npm i
13. exit
14. make stop
15. Remove comment from line 83 in docker compose
16. make build
