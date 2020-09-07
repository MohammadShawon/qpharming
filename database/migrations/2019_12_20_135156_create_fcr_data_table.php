<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFcrDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fcr_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('farmer_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('batch_number')->index();
            $table->decimal('given_chicks_quantity', 8,2);
            $table->decimal('chicks_rate', 8,2);
            $table->decimal('sold_quantity', 8,2);
            $table->decimal('sold_kg', 8,2);
            $table->decimal('average_weight', 8,2);
            $table->decimal('farm_loose_quantity', 8,2);
            $table->decimal('farm_loose_kg', 8,2);
            $table->decimal('farm_stock_quantity', 8,2);
            $table->decimal('farm_stock_kg', 8,2);
            $table->decimal('cartoon_dead', 8,2);
            $table->decimal('farm_dead', 8,2);
            $table->decimal('missing_quantity', 8,2);
            $table->decimal('missing_kg', 8,2);
            $table->decimal('bonus_chicks', 8,2);
            $table->decimal('bonus_chicks_money', 8,2);
            $table->decimal('excess_dead', 8,2);
            $table->decimal('farm_loose_cutting', 8,2);
            $table->decimal('farm_stock_cutting', 8,2);
            $table->decimal('excess_dead_cutting', 8,2);
            $table->decimal('missing_chicks_cutting', 8,2);
            $table->decimal('excess_feed_cutting', 8,2);
            $table->decimal('report_book_cutting', 8,2);
            $table->decimal('transport_cost', 8,2);
            $table->decimal('stamp_cost', 8,2);
            $table->decimal('advance_payment', 8,2);
            $table->decimal('previous_due', 8,2);
            $table->decimal('others_cutting', 8,2);
            $table->decimal('feed_eaten_sacks', 8,2);
            $table->decimal('fcr', 8,2);
            $table->decimal('commission_rate', 8,2);
            $table->decimal('selling_rate', 8,2);
            $table->decimal('farm_loose_rate', 8,2);
            $table->decimal('sub_total', 8,2);
            $table->decimal('total_cutting_amount', 8,2);
            $table->decimal('grand_total', 8,2);
            $table->timestamps();

            $table->foreign('farmer_id')->references('id')->on('farmers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fcr_data');
    }
}
