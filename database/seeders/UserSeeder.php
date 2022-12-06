<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert(
            [
                [
                    'name' => 'test user',
                    'email' => 'test@gmail.com',
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'password' => '$2y$10$0Z28kIbCWOP5pEYoUvjh5eVRGjJ6xUVCjbdJruud1ahYUx6./g1Ge', // password
                    'remember_token' => Str::random(3),
                  
                ],
                
            ],
        );
    }
}
