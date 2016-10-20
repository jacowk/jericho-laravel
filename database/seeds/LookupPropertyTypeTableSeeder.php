<?php

use Illuminate\Database\Seeder;
use jericho\LookupPropertyType;

class LookupPropertyTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	LookupPropertyType::truncate();
    	
    	$property_type_array = array('Farm', 'Flat', 'Townhouse', 'Freehold', 'Other');
    	foreach($property_type_array as $property_type)
    	{
    		$lookup_property_type = new LookupPropertyType();
    		$lookup_property_type->description = $property_type;
    		$lookup_property_type->created_by_id = 1;
    		$lookup_property_type->save();
    	}
    	
    	$faker = Faker\Factory::create();
    	foreach(range(1, 20) as $index)
    	{
    		LookupPropertyType::create([
    				'description' => $faker->word,
    				'created_by_id' => 1
    		]);
    	}
    }
}
