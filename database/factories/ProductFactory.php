<?php

namespace Database\Factories;

use App\Models\User;
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
    public function definition()
    {
        return [
            'name' => fake()->sentence(),
            'price' => fake()->numberBetween(100, 1000),
            'user_id' => User::permission('products.store')->get()->random()->id,
            'properties' => [
                ['key' => fake()->word(), 'value' => fake()->sentence()],
                ['key' => fake()->word(), 'value' => fake()->sentence()],
                ['key' => fake()->word(), 'value' => fake()->sentence()]
            ]
        ];
    }
}
