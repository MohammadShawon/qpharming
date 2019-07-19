<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmerBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmer_batches', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('farmer_id')->unsigned()->index();
            $table->foreign('farmer_id')->references('id')->on('farmers')->onDelete('cascade');

            $table->bigInteger('user_id')->unsigned()->index();
            

            $table->string('batch_number')->unique();
            $table->string('batch_name')->unique();
            $table->enum('status',['active', 'inactive', 'disabled']);

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
        Schema::dropIfExists('farmer_batches');
    }
}
