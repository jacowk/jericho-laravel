<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\LookupAttorneyType;

/**
 * A component for retrieving attorney types to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-02
 *
 */
class AttorneyTypeLookupRetriever implements Component
{
	public function execute()
	{
		$lookup_attorney_types = LookupAttorneyType::all();
		$attorney_types = array();
		$attorney_types[-1] = "Select Attorney Type";
		foreach($lookup_attorney_types as $attorney_type)
		{
			$attorney_types[$attorney_type->id] = $attorney_type->description;
		}
		return $attorney_types;
	}
}