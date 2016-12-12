<?php

use Illuminate\Database\Seeder;
use jericho\LookupPropertyType;

/**
 * A seeder for creating initial property types for the production database
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-28
 *
 */
class ProductionLookupPropertyTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	LookupPropertyType::truncate();
    	 
    	$property_type_array = array(
    			'Farm',
    			'Flat',
    			'Townhouse',
    			'Freehold',
    			'Housing Estate',
    			'Other'
    	);
    	foreach($property_type_array as $property_type)
    	{
    		$lookup_property_type = new LookupPropertyType();
    		$lookup_property_type->description = $property_type;
    		$lookup_property_type->created_by_id = 1;
    		$lookup_property_type->save();
    	}
    }
}
