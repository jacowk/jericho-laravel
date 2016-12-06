<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\PropertyStatus;

/**
 * A component for retrieving property status to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-12-06
 *
 */
class PropertyStatusLookupRetriever implements Component
{
	public function execute()
	{
		$table_property_statuses = PropertyStatus::all();
		$property_statuses = array();
		$property_statuses[-1] = "Select Property Status";
		foreach($table_property_statuses as $property_status)
		{
			$property_statuses[$property_status->id] = $property_status->description;
		}
		return $property_statuses;
	}
}