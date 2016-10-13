<?php

use Illuminate\Database\Seeder;
use jericho\DiaryItem;
use jericho\FollowupItem;

class FollowupItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $diary_item = DiaryItem::find(1);
        $followup_item1 = new FollowupItem();
        $followup_item1->comments = "This is test followup comment 1";
        $followup_item1->created_by_id = 1;
        $diary_item->followup_items()->save($followup_item1);
        
        $followup_item2 = new FollowupItem();
        $followup_item2->comments = "This is test followup comment 2";
        $followup_item2->created_by_id = 1;
        $diary_item->followup_items()->save($followup_item2);
        
        $followup_item3 = new FollowupItem();
        $followup_item3->comments = "This is test followup comment 3";
        $followup_item3->created_by_id = 1;
        $diary_item->followup_items()->save($followup_item3);
    }
}
