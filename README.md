# Invoice-Receipt Management System

## Setup

1. `laravel new invoice-receipt`
2. select -> none
3. select -> 0
4. select -> mysql
5. select -> no
6. select -> no
   
> [!IMPORTANT]
> Start from here 

7. - install composer:
   
    `composer install`
   - setup Fortify:
      
    ```composer require laravel/fortify```

   - setup Dompdf (for downloading the pdf):
    
    ```composer require barryvdh/laravel-dompdf```
8. `npm i` and `npm run build`
9. config username, password, database name in `.env` file
10. Migrate data into database [^1]:

    `php artisan migrate`

11. Seed data into database [^1]:
    
    `php artisan db:seed`
[^1]: or migrate and seed data at the same time (NOT RECOMMENDED WITH DATA ALREADY EXISTED IN DATABASE): `php artisan migrate:fresh --seeder` 

> [!WARNING]
> Before running the project user MUST enter this `php artisan key:generate` inorder to run without error

12. run:
    ```php artisan serve```

> [!NOTE]
> Login for Admin, Employee[^2].

[^2]: user can login neither with email or username BUT choose 1 only
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
