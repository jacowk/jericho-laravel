<?php

use Illuminate\Database\Seeder;
use jericho\Property;

class PropertyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Property::truncate();
    	
    	$property1 = new Property();
    	$property1->address_line_1 = "10 Some Street";
    	$property1->address_line_2 = "xxxxxx";
    	$property1->address_line_3 = "xxxxxx";
    	$property1->address_line_4 = "xxxxxx";
    	$property1->address_line_5 = "xxxxxx";
    	$property1->suburb_id = 1;
    	$property1->area_id = 1;
    	$property1->greater_area_id = 1;
    	$property1->created_by_id = 1;
    	$property1->portion_number = 1;
    	$property1->erf_number = 1177;
    	$property1->size = 90;
    	$property1->save();
    	
    	$property2 = new Property();
    	$property2->address_line_1 = "20 Some Street";
    	$property2->address_line_2 = "xxxxxx";
    	$property2->address_line_3 = "xxxxxx";
    	$property2->address_line_4 = "xxxxxx";
    	$property2->address_line_5 = "xxxxxx";
    	$property2->suburb_id = 1;
    	$property2->area_id = 1;
    	$property2->greater_area_id = 1;
    	$property2->created_by_id = 1;
    	$property2->portion_number = 1;
    	$property2->erf_number = 1178;
    	$property2->size = 95;
    	$property2->save();
    	
    	$property3 = new Property();
    	$property3->address_line_1 = "30 Some Street";
    	$property3->address_line_2 = "xxxxxx";
    	$property3->address_line_3 = "xxxxxx";
    	$property3->address_line_4 = "xxxxxx";
    	$property3->address_line_5 = "xxxxxx";
    	$property3->suburb_id = 1;
    	$property3->area_id = 1;
    	$property3->greater_area_id = 1;
    	$property3->created_by_id = 1;
    	$property3->portion_number = 1;
    	$property3->erf_number = 1179;
    	$property3->size = 100;
    	$property3->save();
    	
//     	$faker = Faker\Factory::create();
//     	foreach(range(1, 20) as $index)
//     	{
//     		Property::create([
//     				'address_line_1' => $faker->address,
//     				'suburb_id' => $faker->numberBetween(1, 5),
//     				'area_id' => $faker->numberBetween(1, 5),
//     				'greater_area_id' => $faker->numberBetween(1, 5),
//     				'portion_number' => $faker->numberBetween(1, 5),
//     				'erf_number' => $faker->numberBetween(100, 999),
//     				'size' => $faker->numberBetween(50, 1000),
//     				'created_by_id' => 1
//     		]);
//     	}
    }
}
