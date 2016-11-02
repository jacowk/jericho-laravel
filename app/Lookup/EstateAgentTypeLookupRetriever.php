<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\LookupEstateAgentType;

/**
 * A component for retrieving Estate Agent types to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-02
 *
 */
class EstateAgentTypeLookupRetriever implements Component
{
	public function execute()
	{
		$lookup_estate_agent_types = LookupEstateAgentType::all();
		$estate_agent_types = array();
		$estate_agent_types[-1] = "Select Estate Agent Type";
		foreach($lookup_estate_agent_types as $estate_agent_type)
		{
			$estate_agent_types[$estate_agent_type->id] = $estate_agent_type->description;
		}
		return $estate_agent_types;
	}
}