<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sale_id')->unsigned()->index();
            $table->bigInteger('product_id')->unsigned()->index();
            $table->string('batch_no');
            $table->decimal('cost_price',15,2);
            $table->decimal('selling_price',15,2);
            $table->decimal('discount',15,2);
            $table->bigInteger('unit_id')->unsigned()->index();
            $table->decimal('quantity',8,2);
            $table->decimal('total_cost',15,2);
            $table->decimal('total_selling',15,2);
            $table->timestamps();

            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
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
        Schema::dropIfExists('sale_items');
    }
}
