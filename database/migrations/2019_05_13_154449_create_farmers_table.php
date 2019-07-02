<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('branch_id')->unsigned()->index();
            $table->string('name');
            $table->string('phone1')->unique();
            $table->string('phone2')->nullable();
            $table->string('email')->nullable();
            $table->text('address');
            $table->decimal('opening_balance', 15, 2)->default(0);
            $table->dateTime('starting_date');
            $table->dateTime('ending_date')->nullable();
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
        Schema::dropIfExists('farmers');
    }
}
