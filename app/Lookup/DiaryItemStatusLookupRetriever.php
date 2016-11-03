<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\DiaryItemStatus;

/**
 * A component for retrieving diary item status to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class DiaryItemStatusLookupRetriever implements Component
{
	public function execute()
	{
		$table_diary_item_statuses = DiaryItemStatus::all();
		$diary_item_statuses = array();
		$diary_item_statuses[-1] = "Select Diary Item Status";
		foreach($table_diary_item_statuses as $diary_item_status)
		{
			$diary_item_statuses[$diary_item_status->id] = $diary_item_status->description;
		}
		return $diary_item_statuses;
	}
}