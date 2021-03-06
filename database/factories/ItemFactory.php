<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->text(50),
            'quantity' => $this->faker->randomFloat(2, 0, 100),
            'price_buy' => $this->faker->randomFloat(2, 0, 100),
            'price_sell' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
