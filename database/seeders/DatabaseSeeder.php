<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

use function Symfony\Component\String\b;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();

        //Create a user with nit = 12345678 and password = 12345678
        User::create([
            'nit' => 12345678,
            'name' => 'John Doe',
            'email' => 'johndoe@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        //Seeder Item
        $this->call(ItemSeeder::class);
        //Seeder Customer
        $this->call(CustomerSeeder::class);
        //Seeder Invoice
        $this->call(InvoiceSeeder::class);
    }
}
