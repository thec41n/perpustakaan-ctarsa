<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'user_id' => User::inRandomOrder()->first()->id,
            'category_id' => Category::pluck('id')->random(),
            'author' => $this->faker->name,
            'publisher' => $this->faker->company,
            'year' => $this->faker->year,
            'description' => $this->faker->paragraph,
            'quantity' => $this->faker->numberBetween(1, 100),
            'file_path' => $this->faker->randomElement(['/path/to/file1.pdf', '/path/to/file2.pdf']),
            'cover_image' => $this->faker->randomElement(['/path/to/cover1.jpg', '/path/to/cover2.jpg'])
        ];
    }
}
