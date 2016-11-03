<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\GreaterArea;

/**
 * A component for retrieving attorney types to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-02
 *
 */
class GreaterAreaLookupRetriever implements Component
{
	public function execute()
	{
		$table_greater_areas = GreaterArea::orderBy('name', 'asc')->get();
		$greater_areas = array();
		$greater_areas[-1] = "Select Greater Area";
		foreach($table_greater_areas as $greater_area)
		{
			$greater_areas[$greater_area->id] = $greater_area->name;
		}
		return $greater_areas;
	}
}