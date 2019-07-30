<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->unsigned()->index();
            $table->string('batch_no')->unique();
            $table->decimal('quantity',8,2);
            $table->decimal('sold',8,2);
            $table->decimal('cost_price',20,2);
            $table->decimal('selling_price',20,2);
            $table->dateTime('mfg_date');
            $table->dateTime('exp_date');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_prices');
    }
}
