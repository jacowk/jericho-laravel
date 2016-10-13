<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttorneyAuditTrailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//         Schema::create('attorney_audit_trails', function (Blueprint $table) {
//             $table->bigIncrements('id');
//             $table->bigInteger('attorney_id');
//             $table->string('name');
//             $table->integer('attorney_type_id')->nullable();
//             $table->bigInteger('created_by_id');
//             $table->timestamps();
//         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//         Schema::dropIfExists('attorney_audit_trails');
    }
}
