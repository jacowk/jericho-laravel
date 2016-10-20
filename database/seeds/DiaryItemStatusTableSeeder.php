<?php

use Illuminate\Database\Seeder;
use jericho\DiaryItemStatus;

class DiaryItemStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DiaryItemStatus::truncate();
    	
        $diary_item_status1 = new DiaryItemStatus();
        $diary_item_status1->description = 'Open';
        $diary_item_status1->created_by_id = 1;
        $diary_item_status1->save();
        
        $diary_item_status2 = new DiaryItemStatus();
        $diary_item_status2->description = 'Closed';
        $diary_item_status2->created_by_id = 1;
        $diary_item_status2->save();
    }
}
