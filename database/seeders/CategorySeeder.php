<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Category::create(['name' => 'Matematika']);
        \App\Models\Category::create(['name' => 'Ilmu Komputer']);
        \App\Models\Category::create(['name' => 'Literatur']);
    }
}
