<?php

use Illuminate\Database\Seeder;
use jericho\LookupContractorType;

class LookupContractorTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$contractor_type_array = array('Electrician', 'Tiler', 'Builder', 'Painter');
    	foreach($contractor_type_array as $contractor_type)
    	{
    		$lookup_contractor_type = new LookupContractorType();
    		$lookup_contractor_type->description = $contractor_type;
    		$lookup_contractor_type->created_by_id = 1;
    		$lookup_contractor_type->save();
    	}
    }
}
