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
    	
        $seller_status1 = new SellerStatus();
        $seller_status1->description = 'Not Actioned';
        $seller_status1->created_by_id = 1;
        $seller_status1->save();
        
        $seller_status2 = new SellerStatus();
        $seller_status2->description = 'Pending';
        $seller_status2->created_by_id = 1;
        $seller_status2->save();
        
        $seller_status3 = new SellerStatus();
        $seller_status3->description = 'Interested';
        $seller_status3->created_by_id = 1;
        $seller_status3->save();
        
        $seller_status4 = new SellerStatus();
        $seller_status4->description = 'Not Interested';
        $seller_status4->created_by_id = 1;
        $seller_status4->save();
    }
}
