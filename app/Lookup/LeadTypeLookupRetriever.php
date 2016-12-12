<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\LookupLeadType;

/**
 * A component for retrieving lead types to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-12-12
 *
 */
class LeadTypeLookupRetriever implements Component
{
	public function execute()
	{
		$lookup_lead_types = LookupLeadType::all();
		$lead_types = array();
		$lead_types[-1] = "Select Lead Type";
		foreach($lookup_lead_types as $lead_type)
		{
			$lead_types[$lead_type->id] = $lead_type->description;
		}
		return $lead_types;
	}
}