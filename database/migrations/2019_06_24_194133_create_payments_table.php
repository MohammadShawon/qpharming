<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bank_id')->unsigned()->index();
            $table->bigInteger('purposehead_id')->unsigned()->index();
            $table->bigInteger('company_id')->unsigned()->index()->nullable();
            $table->bigInteger('farmer_id')->unsigned()->index()->nullable();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->string('payee_type');
            $table->decimal('payment_amount', 15, 2)->default(0);
            $table->string('payment_type');
            $table->string('bank_name')->nullable();
            $table->string('reference');
            $table->string('received_by');
            $table->string('remarks')->nullable();
            $table->dateTime('payment_date');
            $table->softDeletes();
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
        Schema::dropIfExists('payments');
    }
}
