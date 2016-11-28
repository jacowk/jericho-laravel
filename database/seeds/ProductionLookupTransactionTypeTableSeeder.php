<?php

use Illuminate\Database\Seeder;
use jericho\LookupTransactionType;

class ProductionLookupTransactionTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	LookupTransactionType::truncate();
    	
    	$type_array = array('Renovations', 'Purchase Price', 'Legal Fees', 'Sourcing Fees');
    	foreach($type_array as $type)
    	{
    		$lookup_type = new LookupTransactionType();
    		$lookup_type->description = $type;
    		$lookup_type->created_by_id = 1;
    		$lookup_type->save();
    	}
    }
}
