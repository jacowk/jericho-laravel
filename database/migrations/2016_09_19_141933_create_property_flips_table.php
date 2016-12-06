<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyFlipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_flips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('reference_number');
            $table->string('title_deed_number');
            $table->string('case_number')->nullable();
            $table->bigInteger('seller_id')->nullable(); //Contact ID
            $table->bigInteger('selling_price')->nullable();
            $table->integer('seller_status_id')->nullable();
            $table->bigInteger('purchaser_id')->nullable(); //Contact ID
            $table->bigInteger('purchase_price')->nullable();
            $table->integer('finance_status_id')->nullable();
            $table->integer('property_status_id')->nullable();
            $table->bigInteger('property_id');
            $table->bigInteger('created_by_id');
            $table->bigInteger('updated_by_id')->nullable();
            $table->bigInteger('deleted_by_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_flips');
    }
}
