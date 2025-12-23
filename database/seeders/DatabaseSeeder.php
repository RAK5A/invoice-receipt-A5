<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@step.org',
            'phone' => '1234567890',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Employee 1',
            'username' => 'employee_1',
            'email' => 'employee1@step.org',
            'phone' => '0987654321',
            'password' => Hash::make('employee123'),
            'role' => 'employee',
        ]);

        User::create([
            'name' => 'Employee 2',
            'username' => 'employee_2',
            'email' => 'employee2@step.org',
            'phone' => '098765432',
            'password' => Hash::make('employee1234'),
            'role' => 'employee',
        ]);

        // \App\Models\Category::factory(10)->create();
    }
}
