Backend

Requirements
1- PHP 8.1 or higher
2- Postgresql database server
3- Composer 2.*

Project Setup
1- Create a new postgresql database
2- Configure /backend/.env for your postgres database. For example:
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=reviews
    DB_USERNAME=postgres
    DB_PASSWORD=my_new_secure_password
3- Navigate to /backend
4- Run php artisan migrate
5- Run database seeders
    1- php artisan db:seed --class=UserSeeder
        1- It creates 10 users with random data and each user will have the following password: password
        2- It creates 1 admin linked with the first random user in database
    2- php artisan db:seed --class=CompanySeeder
    3- php artisan db:seed --class=PostSeeder
    4- php artisan db:seed --class=CommentSeeder
    5- php artisan db:seed --class=CitySeeder
6- Access your postgres database from shell (Linux)
    1- sudo su - <username> (postgres is the standard username)
    2- psql -d <database-name>
    3- \dt - Lists all the tables
    4- SELECT * FROM <table-name>; - List all rows in a table


Frontend:

Requirements
1- NodeJS 19.7.0 or higher

Project Setup
1- Navigate to /frontend
2- switch to node 19.7.0 or higher
3- Run npm install