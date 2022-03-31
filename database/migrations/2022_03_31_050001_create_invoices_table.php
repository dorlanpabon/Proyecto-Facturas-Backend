<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            //number of the invoice
            $table->string('number', 20)->unique();
            //date and time of the invoice
            $table->dateTime('date');
            //nit of the client
            $table->string('customer_nit', 20);
            //nit of the seller
            $table->string('seller_nit', 20);
            //total amount of the invoice (without iva)
            $table->decimal('total_without_iva', 10, 2);
            //iva of the invoice
            $table->decimal('iva', 10, 2);
            //total amount of the invoice (with iva)
            $table->decimal('total_with_iva', 10, 2);

            //foreign keys
            $table->foreign('customer_nit')->references('nit')->on('customers');
            $table->foreign('seller_nit')->references('nit')->on('users');

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
        Schema::dropIfExists('invoices');
    }
}
