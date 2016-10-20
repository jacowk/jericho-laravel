<?php

use Illuminate\Database\Seeder;
use jericho\PropertyFlip;
use jericho\Contact;
use Carbon\Carbon;

class EstateAgentPropertyFlipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('estate_agent_property_flip')->truncate();
    	
    	$contact = Contact::find(1);
    	$property_flip = PropertyFlip::find(1);
    	$property_flip->estate_agents()->attach($contact, [
    		'lookup_estate_agent_type_id' => 1,
    		'created_by_id' => 1,
    		'created_at' => new Carbon
    	]);
    	 
    	$contact2 = Contact::find(5);
    	$property_flip->estate_agents()->attach($contact2, [
    		'lookup_estate_agent_type_id' => 1,
    		'created_by_id' => 1,
    		'created_at' => new Carbon
    	]);
    }
}
