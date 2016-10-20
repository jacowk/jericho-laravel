<?php

use Illuminate\Database\Seeder;
use jericho\Contact;
use jericho\PropertyFlip;
use Carbon\Carbon;

/**
 * A seeder for populating the investor_propert_flip pivot table, which creates a relationship between
 * a property flip and contact, as an investor
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-17
 *
 */
class InvestorPropertyFlipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('investor_property_flip')->truncate();
    	
    	$contact = Contact::find(1);
    	$property_flip = PropertyFlip::find(1);
    	$property_flip->investors()->attach($contact, [
    			'investment_amount' => 100000,
    			'created_by_id' => 1,
    			'created_at' => new Carbon
    	]);
    	 
    	$contact2 = Contact::find(3);
    	$property_flip->investors()->attach($contact2, [
    			'investment_amount' => 100000,
    			'created_by_id' => 1,
    			'created_at' => new Carbon
    	]);
    }
}
