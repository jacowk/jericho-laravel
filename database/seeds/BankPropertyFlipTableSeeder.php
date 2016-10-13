<?php

use Illuminate\Database\Seeder;
use jericho\Contact;
use jericho\PropertyFlip;
use Carbon\Carbon;

class BankPropertyFlipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contact = Contact::find(1);
    	$property_flip = PropertyFlip::find(1);
    	$property_flip->banks()->attach($contact, [
    			'created_by_id' => 1,
    			'created_at' => new Carbon
    	]);
    	
    	$contact2 = Contact::find(4);
    	$property_flip->banks()->attach($contact2, [
    			'created_by_id' => 1,
    			'created_at' => new Carbon
    	]);
    }
}
