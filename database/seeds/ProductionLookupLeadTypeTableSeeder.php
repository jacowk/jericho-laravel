<?php

use Illuminate\Database\Seeder;

/**
 * A seeder for populating the system with Lead types for production
 *
 * @author Jaco Koekemoer
 * Date: 2016-12-12
 *
 */
class ProductionLookupLeadTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	LookupLeadType::truncate();
    	
    	$lead_type_array = array(
    			'Sheriff Leads',
    			'High Court Leads',
    			'Referred Client Leads',
    			'Sourcing Agent Leads',
    			'Government Gazette'
    	);
    	foreach($lead_type_array as $lead_type)
    	{
    		$lookup_lead_type = new LookupLeadType();
    		$lookup_lead_type->description = $lead_type;
    		$lookup_lead_type->created_by_id = 1;
    		$lookup_lead_type->save();
    	}
    }
}
