<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration for the issues table
 *
 * @author Jaco Koekemoer
 * Date: 2016-10-19
 *
 */
class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('assigned_to_id')->index(); /* User table lookup */
            $table->integer('lookup_issue_component_id');
            $table->integer('lookup_issue_category_id');
            $table->integer('lookup_issue_severity_id');
            $table->integer('issue_status_id');
            $table->longText('description');
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
        Schema::dropIfExists('issues');
    }
}
