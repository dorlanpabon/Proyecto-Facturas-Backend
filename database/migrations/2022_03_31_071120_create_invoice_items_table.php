<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            //invoice_number of invoice
            $table->string('invoice_number', 20);
            //description of the item
            $table->string('description', 100);
            //quantity of the item
            $table->integer('quantity');
            //price of the item unit
            $table->decimal('price', 10, 2);
            //total price of the item
            $table->decimal('total', 10, 2);
            //id of the item
            $table->bigInteger('item_id')->unsigned();

            //foreign keys
            $table->foreign('invoice_number')->references('number')->on('invoices');
            $table->foreign('item_id')->references('id')->on('items');

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
        Schema::dropIfExists('invoice_items');
    }
}
