<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'Admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('Admin123'),
            ]
        );
    }
}
