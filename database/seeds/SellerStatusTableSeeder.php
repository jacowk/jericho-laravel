<?php

use Illuminate\Database\Seeder;
use jericho\SellerStatus;

class SellerStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	SellerStatus::truncate();
    	 
    	$seller_status_array = array(
    			'Not Actioned',
    			'Pending',
    			'Interested',
    			'Not Interested'
    	);
    	foreach($seller_status_array as $seller_status_value)
    	{
    		$seller_status = new SellerStatus();
    		$seller_status->description = $seller_status_value;
    		$seller_status->created_by_id = 1;
    		$seller_status->save();
    	}
    }
}
