<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('purchase_id')->unsigned()->index();
            $table->bigInteger('product_id')->unsigned()->index();
            $table->string('batch_no');
            $table->decimal('cost_price',15,2);
            $table->decimal('discount',15,2);
            $table->bigInteger('unit_id')->unsigned()->index();
            $table->decimal('quantity',8,2);
            $table->decimal('total_cost',15,2);
            $table->timestamps();

            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('restrict');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_items');
    }
}
