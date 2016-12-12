<?php

use Illuminate\Database\Seeder;
use jericho\GreaterArea;

class GreaterAreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	GreaterArea::truncate();
    	
    	$greater_area_array = array('North', 'South', 'East', 'West', 'Other');
    	foreach($greater_area_array as $greater_area_value)
    	{
    		$greater_area = new GreaterArea();
    		$greater_area->name = $greater_area_value;
    		$greater_area->created_by_id = 1;
    		$greater_area->save();
    	}

//         for ($i = 0; $i < 25; $i++)
//         {
//         	$greater_area = new GreaterArea();
//         	$greater_area->name = "Test Greater Area " . $i;
//         	$greater_area->created_by_id = 1;
//         	$greater_area->save();
//         }
        
//         $faker = Faker\Factory::create();
//         foreach(range(1, 20) as $index)
//         {
//         	GreaterArea::create([
//         			'name' => $faker->word,
//         			'created_by_id' => 1
//         	]);
//         }
    }
}
