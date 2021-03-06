<?php

use Illuminate\Database\Seeder;
use jericho\LookupTransactionType;

class LookupTransactionTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	LookupTransactionType::truncate();
    	 
    	$type_array = array(
    			'Renovations', 
    			'Purchase Price (Deposit + Balance)', 
    			'Legal Fees', 
    			'Sourcing Fees',
    			'Ejection Costs',
				'Municipal Costs',
				'Estate Agent’s Commission',
				'Sheriff’s commission'
    	);
    	foreach($type_array as $type)
    	{
    		$lookup_type = new LookupTransactionType();
    		$lookup_type->description = $type;
    		$lookup_type->created_by_id = 1;
    		$lookup_type->save();
    	}
    }
}
