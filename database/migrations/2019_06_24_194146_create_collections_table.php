<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bank_id')->unsigned()->index();
            $table->bigInteger('farmer_id')->unsigned()->index()->nullable();
            $table->decimal('collection_amount', 15, 2)->default(0);
            $table->string('collection_type');
            $table->string('collect_type')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('given_by')->nullable();
            $table->string('reference')->nullable();
            $table->string('remarks')->nullable();
            $table->dateTime('collection_date');
            $table->enum('status',['active','pending','hold'])->default('pending');
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
        Schema::dropIfExists('collections');
    }
}
