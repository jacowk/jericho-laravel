<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMilestonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('milestones', function (Blueprint $table) {
            $table->bigIncrements('id');
//             $table->date('date_offer_made')->nullable();
//             $table->date('date_of_acceptance')->nullable();
//             $table->date('date_of_seller_signature')->nullable();
//             $table->date('date_of_purchaser_signature')->nullable();
//             $table->integer('finance_status_id')->nullable();
//             $table->date('renovation_start_date')->nullable();
//             $table->date('renovation_end_date')->nullable();
//             $table->date('for_sale_date')->nullable();
//             $table->date('sell_date')->nullable();
            $table->date('effective_date');
            $table->integer('milestone_type_id');
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
        Schema::dropIfExists('milestones');
    }
}
