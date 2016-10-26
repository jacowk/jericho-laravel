<?php

use Illuminate\Database\Seeder;
use jericho\Attorney;

class AttorneyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Attorney::truncate();

    	for ($i = 0; $i < 25; $i++)
    	{
    		$attorney = new Attorney();
    		$attorney->name = "Test Attorney " . $i;
    		$attorney->created_by_id = 1;
    		$attorney->save();
    	}
        
//         $faker = Faker\Factory::create();
//         foreach(range(1, 100) as $index)
//         {
//         	Attorney::create([
//         			'name' => $faker->word,
//         			'created_by_id' => 1
//         	]);
//         }
    }
}
