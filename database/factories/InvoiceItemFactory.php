<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceItemFactory extends Factory
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
            'description' => $this->faker->text(50),
            'quantity' => $this->faker->randomFloat(2, 0, 100),
            'price' => $this->faker->randomFloat(2, 0, 100),
            'total' => $this->faker->randomFloat(2, 0, 100),
            'item_id' => Item::all()->random()->id,
        ];
    }
}
