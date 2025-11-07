<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'owner@example.com'],
            [
                'username' => 'Owner111',
                'name' => 'Owner',
                'password' => bcrypt('password123'),
                'role' => 'owner',
            ]
        );

        User::updateOrCreate(
            ['email' => 'kasir@example.com'],
            [
                'username' => 'Kasir111',
                'name' => 'Kasir',
                'password' => bcrypt('password123'),
                'role' => 'kasir',
            ]
        );
    }
}
