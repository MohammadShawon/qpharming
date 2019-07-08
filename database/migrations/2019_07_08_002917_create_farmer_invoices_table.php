<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmerInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmer_invoices', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('farmer_id')->unsigned()->index();
            $table->foreign('farmer_id')->references('id')->on('farmers')->onDelete('cascade');

            $table->bigInteger('user_id')->unsigned()->index();
            $table->integer('batch_number');

            $table->dateTime('date');
            $table->integer('invoice_number');
            
            $table->decimal('total_amount');
            $table->enum('status',['active', 'inactive', 'disabled']);
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
        Schema::dropIfExists('farmer_invoices');
    }
}
