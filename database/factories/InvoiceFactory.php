<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => $this->faker->unique()->numberBetween(1000000, 9999999),
            'date' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'customers_nit' => Customer::all()->random()->nit,
            'seller_nit' => User::all()->random()->nit,
            'total_without_iva' => $this->faker->randomFloat(2, 0, 100),
            'iva' => $this->faker->randomFloat(2, 0, 100),
            'total_with_iva' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
