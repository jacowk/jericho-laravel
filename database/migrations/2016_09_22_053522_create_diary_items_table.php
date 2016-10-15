<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiaryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diary_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('followup_date');
            $table->bigInteger('followup_user_id');
            $table->longText('comments');
            $table->integer('status_id');
//             $table->bigInteger('allocated_user_id')->nullable();
            $table->bigInteger('property_flip_id');
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
        Schema::dropIfExists('diary_items');
    }
}
