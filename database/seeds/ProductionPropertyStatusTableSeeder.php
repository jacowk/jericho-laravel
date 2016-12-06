<?php

use Illuminate\Database\Seeder;

/**
 * A seeder for the property_statuses table for production
 *
 * @author Jaco Koekemoer
 * Date: 2016-12-06
 *
 */
class ProductionPropertyStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	PropertyStatus::truncate();
    	 
    	$property_status_array = array(
    		'Acquisition',
    		'Mandate'
    	);
    	foreach($property_status_array as $property_status_value)
    	{
    		$property_status = new PropertyStatus();
    		$property_status->name = $property_status_value;
    		$property_status->created_by_id = 1;
    		$property_status->save();
    	}
    }
}
