<?php

use Illuminate\Database\Seeder;
use jericho\DiaryItemStatus;

/**
 * A seeder for creating initial diary item status for the production database
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-28
 *
 */
class ProductionDiaryItemStatusTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DiaryItemStatus::truncate();
	
		$type_array = array('Open', 'Closed');
		foreach($type_array as $type)
		{
			$lookup_type = new DiaryItemStatus();
			$lookup_type->description = $type;
			$lookup_type->created_by_id = 1;
			$lookup_type->save();
		}
	}
}
