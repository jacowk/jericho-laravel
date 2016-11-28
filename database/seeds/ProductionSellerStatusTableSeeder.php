<?php

use Illuminate\Database\Seeder;
use jericho\SellerStatus;

/**
 * A seeder for creating initial seller status for the production database
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-28
 *
 */
class ProductionSellerStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	SellerStatus::truncate();
    	
    	$type_array = array('Not Actioned',
    			'Pending',
    			'Interested',
    			'Not Interested'
    	);
    	foreach($type_array as $type)
    	{
    		$lookup_type = new SellerStatus();
    		$lookup_type->description = $type;
    		$lookup_type->created_by_id = 1;
    		$lookup_type->save();
    	}
    }
}
