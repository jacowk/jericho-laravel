<?php

use Illuminate\Database\Seeder;
use jericho\Area;

class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Area::truncate();
    	
    	$area1 = new Area();
    	$area1->name = "Roodepoort";
    	$area1->created_by_id = 1;
    	$area1->save();
    	
    	$area2 = new Area();
    	$area2->name = "Krugersdorp";
    	$area2->created_by_id = 1;
    	$area2->save();
    	
    	$area3 = new Area();
    	$area3->name = "Randburg";
    	$area3->created_by_id = 1;
    	$area3->save();
    	
    	$faker = Faker\Factory::create();
    	foreach(range(1, 20) as $index)
    	{
    		Area::create([
    				'name' => $faker->word,
    				'created_by_id' => 1
    		]);
    	}
    }
}
