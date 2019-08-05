<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmerRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmer_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('batch_number');
            $table->dateTime('date');
            $table->integer('age');
            $table->integer('child_death');
            $table->decimal('feed_eaten_kg');
            $table->decimal('feed_eaten_sack')->nullable();
            $table->decimal('feed_left')->nullable();
            $table->decimal('weight');
            $table->text('symptoms')->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('farmer_records');
    }
}
