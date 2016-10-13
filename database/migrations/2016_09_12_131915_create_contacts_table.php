<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('title_id')->nullable(); //lookup_title
            $table->string('firstname');
            $table->string('surname')->nullable();
            $table->string('home_tel_no')->nullable();
            $table->string('work_tel_no')->nullable();
            $table->string('cell_no')->nullable();
            $table->string('fax_no')->nullable();
            $table->string('personal_email')->nullable();
            $table->string('work_email')->nullable();
            $table->bigInteger('id_number')->nullable();
            $table->string('passport_number')->nullable();
            $table->integer('marital_status_id')->nullable(); //lookup_marital_status
            $table->string('tax_number')->nullable();
            $table->boolean('sa_citizen')->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
