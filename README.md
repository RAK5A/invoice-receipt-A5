# Invoice-Receipt Management System

## Setup
1. laravel new invoice-receipt
2. select -> none
3. select -> 0
4. select -> mysql
5. select -> no
6. select -> no
7. npm i
8. config username, password, database name in .env
9. ```php artisan migrate```
10. ```php artisan db:seed``` (seed data into database)
11. > setup Fortify:
    ```composer require laravel/fortify```
    - after that enter this command:
    ```php artisan fortify:install```
    - and migrate again:
    ```php artisan migrate```
    or
    ```php artisan migrate:fresh --seeder``` (migrate and seed data at the same time)

12. > setup Dompdf (for downloading the pdf):
    ```composer require barryvdh/laravel-dompdf```
13. run: ```php artisan serve```
