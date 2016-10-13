<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('description');
            $table->text('generated_filename')->nullable();
            $table->text('filename')->nullable();
            $table->integer('file_size')->nullable();
            $table->text('client_original_name')->nullable();
            $table->text('client_original_extension')->nullable();
            $table->text('mime_type')->nullable();
            $table->binary('file')->nullable();
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
        Schema::dropIfExists('documents');
    }
}
