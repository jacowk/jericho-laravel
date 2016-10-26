<?php

use Illuminate\Database\Seeder;
use jericho\LookupEstateAgentType;

class LookupEstateAgentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	LookupEstateAgentType::truncate();
    	
    	$estate_agent_type_array = array('Selling Estate Agent', 'Purchasing Estate Agent');
    	foreach($estate_agent_type_array as $estate_agent_type)
    	{
    		$lookup_estate_agent_type = new LookupEstateAgentType();
    		$lookup_estate_agent_type->description = $estate_agent_type;
    		$lookup_estate_agent_type->created_by_id = 1;
    		$lookup_estate_agent_type->save();
    	}
    	
//     	for ($i = 0; $i < 25; $i++)
//     	{
//     		$lookup_estate_agent_type = new LookupEstateAgentType();
//     		$lookup_estate_agent_type->description = "Test Estate Agent Type " . $i;
//     		$lookup_estate_agent_type->created_by_id = 1;
//     		$lookup_estate_agent_type->save();
//     	}
    	
//     	$faker = Faker\Factory::create();
//     	foreach(range(1, 20) as $index)
//     	{
//     		LookupEstateAgentType::create([
//     				'description' => $faker->word,
//     				'created_by_id' => 1
//     		]);
//     	}
    }
}
