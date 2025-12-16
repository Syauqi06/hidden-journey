<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Hidden',
            'email' => 'admin@gmail.com',
            'password' => ('password'), // hash password di model User
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Pengelana Santai',
            'email' => 'user@gmail.com',
            'password' => ('password'),
            'role' => 'user',
        ]);
    }
}
