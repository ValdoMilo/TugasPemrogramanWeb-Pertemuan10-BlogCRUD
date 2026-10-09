<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(6);
        $categories = ['Teknologi', 'Pemrograman', 'Tips', 'Berita', 'Tutorial'];

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . uniqid(),
            'excerpt' => fake()->paragraph(2),
            'body' => fake()->paragraphs(6, true),
            'category' => fake()->randomElement($categories),
            'status' => fake()->randomElement(['draft', 'published', 'published', 'published']),
            'image' => null,
        ];
    }
}