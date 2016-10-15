<?php

use Illuminate\Database\Seeder;
use jericho\DiaryItem;

class DiaryItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $diary_item = new DiaryItem();
        $diary_item->property_flip_id = 1;
//         $diary_item->allocated_user_id = 1;
        $diary_item->status_id = 1;
        $diary_item->followup_date = date_create_from_format('Y-m-d', '2016-10-01');
        $diary_item->followup_user_id = 1;
        $diary_item->comments = "This is a test";
        $diary_item->created_by_id = 1;
        $diary_item->save();
        
        $diary_item1 = new DiaryItem();
        $diary_item1->property_flip_id = 1;
//         $diary_item1->allocated_user_id = 1;
        $diary_item1->status_id = 1;
        $diary_item1->followup_date = date_create_from_format('Y-m-d', '2016-10-01');
        $diary_item1->followup_user_id = 1;
        $diary_item1->comments = "This is a test 2";
        $diary_item1->created_by_id = 1;
        $diary_item1->save();
    }
}
