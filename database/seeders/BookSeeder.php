<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Book::create([
            'title' => 'Pengantar Algoritma',
            'category_id' => 2,
            'author' => 'John Doe',
            'publisher' => 'XYZ Publisher',
            'year' => 2021,
            'description' => 'Buku pengantar tentang algoritma dasar',
            'quantity' => 50,
            'file_path' => '/path/to/file.pdf',
            'cover_image' => '/path/to/cover.jpg'
        ]);
    }
}
