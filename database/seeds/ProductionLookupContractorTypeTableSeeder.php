<?php

use Illuminate\Database\Seeder;
use jericho\LookupContractorType;

/**
 * A seeder for creating initial contractor types for the production database
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-28
 *
 */
class ProductionLookupContractorTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	LookupContractorType::truncate();
    	 
    	$contractor_type_array = array(
    			'Electrician', 
    			'Tiler', 
    			'Builder', 
    			'Painter',
    			'Plumber',
				'Rubble Removal',
				'Carpenter',
				'Welder',
				'Glazer',
				'Tree Feller',
				'Landscaper'
    	);
    	foreach($contractor_type_array as $contractor_type)
    	{
    		$lookup_contractor_type = new LookupContractorType();
    		$lookup_contractor_type->description = $contractor_type;
    		$lookup_contractor_type->created_by_id = 1;
    		$lookup_contractor_type->save();
    	}
    }
}
