<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\LookupPropertyType;

/**
 * A component for retrieving property types to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class PropertyTypeLookupRetriever implements Component
{
	public function execute()
	{
		$lookup_property_types = LookupPropertyType::all();
		$property_types = array();
		$property_types[-1] = "Select Property Type";
		foreach($lookup_property_types as $property_type)
		{
			$property_types[$property_type->id] = $property_type->description;
		}
		return $property_types;
	}
}