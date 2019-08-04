<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmerInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmer_invoice_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('farmerinvoice_id')->unsigned()->index();
            $table->bigInteger('product_id')->unsigned()->index();
            $table->bigInteger('unit_id')->unsigned()->index();
            $table->string('batch_number')->index();
            $table->decimal('cost_price', 15,2)->default(0);
            $table->decimal('selling_price', 15,2)->default(0);
            $table->decimal('quantity');
            $table->decimal('total_cost', 15, 2)->default(0);
            $table->decimal('total_selling', 15, 2)->default(0);
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
        Schema::dropIfExists('farmer_invoice_items');
    }
}
