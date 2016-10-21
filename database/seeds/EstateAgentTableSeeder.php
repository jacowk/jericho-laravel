<?php

use Illuminate\Database\Seeder;
use jericho\EstateAgent;

class EstateAgentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	EstateAgent::truncate();
    	
        $estateAgent1 = new EstateAgent();
        $estateAgent1->name = "Estate Agent 1";
        $estateAgent1->created_by_id = 1;
        $estateAgent1->save();
        
        $estateAgent2 = new EstateAgent();
        $estateAgent2->name = "Estate Agent 2";
        $estateAgent2->created_by_id = 1;
        $estateAgent2->save();
        
        $estateAgent3= new EstateAgent();
        $estateAgent3->name = "Estate Agent 3";
        $estateAgent3->created_by_id = 1;
        $estateAgent3->save();
        
//         $faker = Faker\Factory::create();
//         foreach(range(1, 20) as $index)
//         {
//         	EstateAgent::create([
//         			'name' => $faker->word,
//         			'created_by_id' => 1
//         	]);
//         }
    }
}
