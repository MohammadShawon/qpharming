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
            $table->bigInteger('purposehead_id')->unsigned()->index();
            $table->bigInteger('company_id')->unsigned()->index()->nullable();
            $table->bigInteger('farmer_id')->unsigned()->index()->nullable();
            $table->decimal('collection_amount', 15, 2)->default(0);
            $table->string('collection_type');
            $table->string('bank_name');
            $table->string('given_by');
            $table->string('remarks');
            $table->dateTime('collection_date');
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
