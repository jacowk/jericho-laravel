<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\Area;

/**
 * A component for retrieving areas to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class AreaLookupRetriever implements Component
{
	public function execute()
	{
		$table_areas = Area::orderBy('name', 'asc')->get();
		$areas = array();
		$areas[-1] = "Select Area";
		foreach($table_areas as $area)
		{
			$areas[$area->id] = $area->name;
		}
		return $areas;
	}
}