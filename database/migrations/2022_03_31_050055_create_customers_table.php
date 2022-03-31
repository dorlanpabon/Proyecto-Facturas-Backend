<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            //nit of the customer
            $table->string('nit', 20)->unique();
            //name of the customer
            $table->string('name', 100);
            //address of the customer
            $table->string('address', 100);
            //phone of the customer
            $table->string('phone', 20);
            //email of the customer
            $table->string('email', 100);

            /* //foreign keys
            $table->foreign('nit')->references('seller_nit')->on('invoices');
             */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
