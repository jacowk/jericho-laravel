<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractorPropertyFlip extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('contractor_property_flip', function (Blueprint $table) {
    		$table->bigInteger('contact_id');
    		$table->bigInteger('property_flip_id');
    		$table->bigInteger('lookup_contractor_type_id');
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
    	Schema::dropIfExists('contractor_property_flip');
    }
}
