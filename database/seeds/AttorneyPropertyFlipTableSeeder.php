<?php

use Illuminate\Database\Seeder;
use jericho\Contact;
use jericho\PropertyFlip;
use Carbon\Carbon;

class AttorneyPropertyFlipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('attorney_property_flip')->truncate();
    	
    	$contact = Contact::find(1);
    	$property_flip = PropertyFlip::find(1);
    	$property_flip->attorneys()->attach($contact, [
    		'lookup_attorney_type_id' => 1,
    		'created_by_id' => 1,
    		'created_at' => new Carbon
    	]);
    	
    	$contact2 = Contact::find(3);
    	$property_flip->attorneys()->attach($contact2, [
    			'lookup_attorney_type_id' => 2,
    			'created_by_id' => 1,
    			'created_at' => new Carbon
    	]);
    }
}
