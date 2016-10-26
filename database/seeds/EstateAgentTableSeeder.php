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
    	
        for ($i = 0; $i < 25; $i++)
        {
        	$estate_agent = new EstateAgent();
        	$estate_agent->name = "Test Estate Agent " . $i;
        	$estate_agent->created_by_id = 1;
        	$estate_agent->save();
        }
        
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
