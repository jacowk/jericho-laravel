<?php

use Illuminate\Database\Seeder;
use jericho\Contractor;

class ContractorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Contractor::truncate();
    	
        for ($i = 0; $i < 50; $i++)
        {
        	$contractor = new Contractor();
        	$contractor->name = "Test Contractor " . $i;
        	$contractor->work_description = "Test Work Description " . $i;
        	$contractor->created_by_id = 1;
        	$contractor->save();
        }
        
//         $faker = Faker\Factory::create();
//         foreach(range(1, 20) as $index)
//         {
//         	Contractor::create([
//         			'name' => $faker->word,
//         			'created_by_id' => 1
//         	]);
//         }
    }
}
