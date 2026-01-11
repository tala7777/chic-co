<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $styles = ['Soft', 'Alt', 'Luxury', 'Clean'];
        $categories = ['Clothing', 'Accessories', 'Shoes', 'Bags'];

        return [
            'name' => fake()->words(3, true),
            'description' => fake()->paragraph(),
            'price' => fake()->numberBetween(30, 300),
            'stock' => fake()->numberBetween(0, 50),
            'category' => fake()->randomElement($categories),
            'style' => fake()->randomElement($styles),
            'image_url' => 'https://source.unsplash.com/random/400x400?fashion',
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
