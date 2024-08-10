<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user_id = User::inRandomOrder()->first()->id;
        \App\Models\Book::create([
            'title' => 'Pengantar Algoritma',
            'user_id' => $user_id,
            'category_id' => 2,
            'author' => 'John Doe',
            'publisher' => 'XYZ Publisher',
            'year' => 2021,
            'description' => 'Buku pengantar tentang algoritma dasar',
            'quantity' => 50,
            'file_path' => '/path/to/file.pdf',
            'cover_image' => '/path/to/cover.jpg'
        ]);

        Book::factory()->count(50)->create();
    }
}
