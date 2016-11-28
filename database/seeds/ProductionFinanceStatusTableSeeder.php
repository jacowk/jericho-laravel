<?php

use Illuminate\Database\Seeder;
use jericho\FinanceStatus;

/**
 * A seeder for creating initial finance status for the production database
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-28
 *
 */
class ProductionFinanceStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	FinanceStatus::truncate();
    	 
    	$type_array = array('Awaiting Acceptance',
    			'Accepted',
    			'Declined');
    	foreach($type_array as $type)
    	{
    		$lookup_type = new FinanceStatus();
    		$lookup_type->description = $type;
    		$lookup_type->created_by_id = 1;
    		$lookup_type->save();
    	}
    }
}
