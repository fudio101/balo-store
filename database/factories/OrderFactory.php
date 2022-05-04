<?php

namespace Database\Factories;

use App\Models\District;
use App\Models\OrderStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'order_code' => $this->faker->regexify('[A-Z][0-9]{8}'),
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'total' => 0,
            'shipping_cost' => 0,
            'coupon' => 0,
            'district_id' => District::all()->random()->id,
            'detailed_address' => $this->faker->address(),
            'order_status_id' => OrderStatus::all()->random()->id,
        ];
    }
}
