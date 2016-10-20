<?php

use Illuminate\Database\Seeder;
use jericho\Contact;
use jericho\PropertyFlip;
use Carbon\Carbon;

class ContractorPropertyFlipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('contractor_property_flip')->truncate();
    	
    	$contact = Contact::find(1);
    	$property_flip = PropertyFlip::find(1);
    	$property_flip->contractors()->attach($contact, [
    			'lookup_contractor_type_id' => 1,
    			'created_by_id' => 1,
    			'created_at' => new Carbon
    	]);
    	
    	$contact2 = Contact::find(4);
    	$property_flip->contractors()->attach($contact2, [
    			'lookup_contractor_type_id' => 2,
    			'created_by_id' => 1,
    			'created_at' => new Carbon
    	]);
    }
}
