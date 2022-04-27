<?php

namespace Database\Factories;

use App\Models\Category;
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
            'category_id' => Category::all()->random()->id,
            'name' => $this->faker->name,
            'avatar' => $this->faker->imageUrl(640, 480, 'animals', true, 'cats'),
            'producer_id' => $this->faker->randomElement([1, 2, 3]),
            'quantity' => $this->faker->numberBetween(15, 3000),
            'price' => $this->faker->numberBetween(250000, 5000000),
        ];
    }
}
