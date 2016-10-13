<?php

use Illuminate\Database\Seeder;
use jericho\Milestone;
use jericho\PropertyFlip;

class MilestoneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $property_flip = PropertyFlip::find(1);
        
        $milestone = new Milestone();
        $milestone->date_offer_made = date_create_from_format('Y-m-d', '2016-09-01');
        $milestone->date_of_acceptance = date_create_from_format('Y-m-d', '2016-09-02');
        $milestone->date_of_seller_signature = date_create_from_format('Y-m-d', '2016-09-03');
        $milestone->date_of_purchaser_signature = date_create_from_format('Y-m-d', '2016-09-04');
        $milestone->finance_status_id = 1;
        $milestone->renovation_start_date = date_create_from_format('Y-m-d', '2016-09-05');
        $milestone->renovation_end_date = date_create_from_format('Y-m-d', '2016-09-06');
        $milestone->for_sale_date = date_create_from_format('Y-m-d', '2016-09-07');
        $milestone->sell_date = date_create_from_format('Y-m-d', '2016-09-08');
        $milestone->created_by_id = 1;
        
        $property_flip->milestone()->save($milestone);
    }
}
