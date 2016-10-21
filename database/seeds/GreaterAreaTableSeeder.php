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
    	
        $greaterArea1 = new GreaterArea();
        $greaterArea1->name = "North";
        $greaterArea1->created_by_id = 1;
        $greaterArea1->save();
        
        $greaterArea2 = new GreaterArea();
        $greaterArea2->name = "South";
        $greaterArea2->created_by_id = 1;
        $greaterArea2->save();
        
        $greaterArea3 = new GreaterArea();
        $greaterArea3->name = "East";
        $greaterArea3->created_by_id = 1;
        $greaterArea3->save();
        
        $greaterArea4 = new GreaterArea();
        $greaterArea4->name = "West";
        $greaterArea4->created_by_id = 1;
        $greaterArea4->save();
        
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
