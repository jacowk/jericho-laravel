<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//         Schema::create('user_activities', function (Blueprint $table) {
//             $table->bigIncrements('id');
//             $table->integer('model_type_id');
//             $table->integer('user_activity_type_id');
//             $table->integer('model_id'); /* The primary key of the affected model */
//             $table->longText('description');
//             $table->bigInteger('created_by_id');
//             $table->bigInteger('updated_by_id')->nullable();
//             $table->bigInteger('deleted_by_id')->nullable();
//             $table->timestamps();
//             $table->softDeletes();
//         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//         Schema::dropIfExists('user_activities');
    }
}
