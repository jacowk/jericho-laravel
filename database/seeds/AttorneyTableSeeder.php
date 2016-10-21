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
    	
        $attorney1 = new Attorney();
        $attorney1->name = "Test Attorney 1";
        $attorney1->created_by_id = 1;
        $attorney1->save();
        
        $attorney2 = new Attorney();
        $attorney2->name = "Test Attorney 2";
        $attorney2->created_by_id = 1;
        $attorney2->save();
        
        $attorney3 = new Attorney();
        $attorney3->name = "Test Attorney 3";
        $attorney3->created_by_id = 1;
        $attorney3->save();
        
//         $faker = Faker\Factory::create();
//         foreach(range(1, 20) as $index)
//         {
//         	Attorney::create([
//         			'name' => $faker->word,
//         			'created_by_id' => 1
//         	]);
//         }
    }
}
