<?php

use Illuminate\Database\Seeder;
use jericho\LookupEstateAgentType;

/**
 * A seeder for creating initial estate agent types for the production database
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-28
 *
 */
class ProductionLookupEstateAgentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	LookupEstateAgentType::truncate();
    	 
    	$estate_agent_type_array = array(
    			'Selling Estate Agent',
    			'Purchasing Estate Agent',
    			'Sourcing Agent'
    	);
    	foreach($estate_agent_type_array as $estate_agent_type)
    	{
    		$lookup_estate_agent_type = new LookupEstateAgentType();
    		$lookup_estate_agent_type->description = $estate_agent_type;
    		$lookup_estate_agent_type->created_by_id = 1;
    		$lookup_estate_agent_type->save();
    	}
    }
}
