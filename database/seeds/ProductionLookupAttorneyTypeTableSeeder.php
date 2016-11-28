<?php

use Illuminate\Database\Seeder;
use jericho\LookupAttorneyType;

/**
 * A seeder for creating initial attorney types for the production database
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-28
 *
 */
class ProductionLookupAttorneyTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	LookupAttorneyType::truncate();
    	 
    	$attorney_type_array = array('Transfer Attorney', 
    			'Bond Registering Attorney', 
    			'Bond Cancellation Attorney');
    	foreach($attorney_type_array as $attorney_type)
    	{
    		$lookup_attorney_type = new LookupAttorneyType();
    		$lookup_attorney_type->description = $attorney_type;
    		$lookup_attorney_type->created_by_id = 1;
    		$lookup_attorney_type->save();
    	}
    }
}
