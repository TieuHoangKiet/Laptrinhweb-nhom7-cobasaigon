<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo admin
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@cobasaigon.com',
            // Provide plain password so the model's 'hashed' cast will hash it once
            'password' => '123456',
            'role' => 'admin',
        ]);

        // Tạo 7 user khách hàng khác
        User::factory()->create([
             'name' => 'Nguyen Van A',
             'email' => 'Nguyen@gmail.com',
             'password' => '123456',
             'role' => 'customer',
         ]);

         User::factory()->create([
             'name' => 'Customer User 2',
             'email' => 'customer2@example.com',
             'password' => 'password',
             'role' => 'customer',
         ]);

         // Lặp lại hoặc sử dụng vòng lặp nếu cần nhiều hơn
         User::factory(6)->create([
             'role' => 'customer',
         ]);

        // Tạo 1 admin nữa
         User::factory()->create([
             'name' => 'Admin User 2',
             'email' => 'admin2@cobasaigon.com',
             'password' => Hash::make('123456'),
             'role' => 'admin',
         ]);
    }
}