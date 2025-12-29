# Invoice-Receipt Management System

## Setup

1. laravel new invoice-receipt
2. select -> none
3. select -> 0
4. select -> mysql
5. select -> no
6. select -> no
   
> [!IMPORTANT]
> Start from here 

7. install composer:
    `composer install`
8. `npm i` and `npm run build`
9. config username, password, database name in .env
10. `php artisan migrate`
11. `php artisan db:seed` (seed data into database)
    or
    `php artisan migrate:fresh --seeder`
12. - setup Fortify:
    ```composer require laravel/fortify```
    - and migrate again:
    ```php artisan migrate```
    or
    ```php artisan migrate:fresh --seeder``` (migrate and seed data at the same time)
12. setup Dompdf (for downloading the pdf):
    ```composer require barryvdh/laravel-dompdf```

> [!WARNING]
> Before running the file user MUST enter this `php artisan key:generate` inorder to run without error

14. - run:
    ```php artisan serve```

> [!NOTE]
> user can login either email or username
> - Login for Admin, Employee
### Admin:
```
- email: admin@step.org
- username: admin
- password: admin123
```

### employee 1:
```
- email: employee1@step.org
- username: employee_1
- password: employee123
```

### employee 2:
```
- email: employee2@step.org
- username: employee_2
- password: employee1234
```
