<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\Suburb;

/**
 * A component for retrieving suburbs to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class SuburbLookupRetriever implements Component
{
	public function execute()
	{
		$table_suburbs = Suburb::all();
		$suburbs = array();
		$suburbs[-1] = "Select Suburb";
		foreach($table_suburbs as $suburb)
		{
			$suburbs[$suburb->id] = $suburb->name;
		}
		return $suburbs;
	}
}