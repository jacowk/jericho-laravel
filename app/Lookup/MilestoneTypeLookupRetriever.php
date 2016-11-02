<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\LookupMilestoneType;

/**
 * A component for retrieving Milestone types to be used in a dropdown box in a view
 * 
 * @author Jaco Koekemoer
 * Date: 2016-11-02
 *
 */
class MilestoneTypeLookupRetriever implements Component
{
	public function execute()
	{
		$lookup_milestone_types = LookupMilestoneType::all();
		$milestone_types = array();
		$milestone_types[-1] = "Select Milestone Type";
		foreach($lookup_milestone_types as $milestone_type)
		{
			$milestone_types[$milestone_type->id] = $milestone_type->description;
		}
		return $milestone_types;
	}
}