<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discount>
 */
class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $discount = $this->faker->numberBetween(50000, 200000);
        return [
            'code' => $this->faker->regexify('[A-Z0-9]{8}'),
            'discount' => $discount,
            'limit_number' => $this->faker->numberBetween(5, 20),
            'payment_limit' => $this->faker->numberBetween($discount, $discount * 3),
            'expiration_date' => $this->faker->dateTimeBetween('now', '3 months'),
            'description' => $this->faker->text,
        ];
    }
}
