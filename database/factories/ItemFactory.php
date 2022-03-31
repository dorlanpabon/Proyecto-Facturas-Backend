<?php

namespace Database\Factories;

use App\Models\Invoice;
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
            'invoice_number' => Invoice::all()->random()->number,
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'quantity' => $this->faker->randomFloat(2, 0, 100),
            'price' => $this->faker->randomFloat(2, 0, 100),
            'total' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
