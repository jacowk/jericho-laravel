<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\EstateAgent;

/**
 * A component for retrieving Estate Agents to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-02
 *
 */
class EstateAgentLookupRetriever implements Component
{
	public function execute()
	{
		$lookup_estate_agents = EstateAgent::all();
		$estate_agents = array();
		$estate_agents[-1] = "Select Estate Agent";
		foreach($lookup_estate_agents as $estate_agent)
		{
			$estate_agents[$estate_agent->id] = $estate_agent->name;
		}
		return $estate_agents;
	}
}