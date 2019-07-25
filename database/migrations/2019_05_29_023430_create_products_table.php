<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->bigInteger('category_id')->unsigned()->index();
            $table->bigInteger('subcategory_id')->unsigned()->index();
            $table->string('sku')->unique();
            $table->string('product_name');
            $table->string('barcode')->unique()->nullable();
            $table->integer('base_unit_id')->unsigned();
            $table->text('description')->nullable();
            $table->string('size');
//            $table->decimal('cost_price',20,2);
//            $table->decimal('selling_price',20,2);
//            $table->decimal('quantity',20,2);
            $table->timestamps();

            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict');
            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
