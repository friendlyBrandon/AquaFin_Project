<?php

namespace Database\Factories;

use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Material>
 */
class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'productname' => fake()->word(),

            'productnumber' => fake()->unique()->randomNumber(8, true), 

            'category' => fake()->word(),
            
            'stock' => fake()->numberBetween(0, 1000),
        ];
    }
}
