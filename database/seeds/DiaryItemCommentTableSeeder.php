<?php

use Illuminate\Database\Seeder;
use jericho\DiaryItemComment;
use jericho\DiaryItem;

class DiaryItemCommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$diary_item = DiaryItem::find(1);
    	$diary_item_comment1 = new DiaryItemComment();
    	$diary_item_comment1->comment = "This is test followup comment 1";
    	$diary_item_comment1->created_by_id = 1;
    	$diary_item->diary_item_comments()->save($diary_item_comment1);
    	
    	$diary_item_comment2 = new DiaryItemComment();
    	$diary_item_comment2->comment = "This is test followup comment 2";
    	$diary_item_comment2->created_by_id = 1;
    	$diary_item->diary_item_comments()->save($diary_item_comment2);
    	
    	$diary_item_comment3 = new DiaryItemComment();
    	$diary_item_comment3->comment = "This is test followup comment 3";
    	$diary_item_comment3->created_by_id = 1;
    	$diary_item->diary_item_comments()->save($diary_item_comment3);
    }
}
