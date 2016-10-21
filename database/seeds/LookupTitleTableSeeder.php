<?php

use Illuminate\Database\Seeder;
use jericho\LookupTitle;

class LookupTitleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	LookupTitle::truncate();
    	
    	$title_array = array('Mr', 'Miss', 'Ms', 'Mrs', 'Adv', 'Dr', 'Prof', 'Rev', 'Ps');
    	foreach($title_array as $title)
    	{
    		$lookup_title = new LookupTitle();
    		$lookup_title->description = $title;
    		$lookup_title->created_by_id = 1;
    		$lookup_title->save();
    	}
    	
//     	$faker = Faker\Factory::create();
//     	foreach(range(1, 20) as $index)
//     	{
//     		LookupTitle::create([
//     				'description' => $faker->word,
//     				'created_by_id' => 1
//     		]);
//     	}
    }
}
