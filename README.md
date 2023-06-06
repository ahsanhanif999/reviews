Backend

1- Create a new postgres database
2- Configure /backend/.env for your postgres database. For example:
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=reviews
    DB_USERNAME=postgres
    DB_PASSWORD=my_new_secure_password
3- Navigate to /backend
4- Run php artisan migrate


Frontend:

1- Navigate to /frontend
2- switch to node 19.7.0 or higher
3- Run npm install