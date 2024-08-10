<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('123'),
            'role' => 'admin'
        ]);

        \App\Models\User::create([
            'name' => 'User Biasa',
            'email' => 'user@mail.com',
            'password' => bcrypt('123'),
            'role' => 'user'
        ]);
    }
}
