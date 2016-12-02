<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use DB;

/**
 * A component for retrieving contacts for estate agents for ajax to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class ContactEstateAgentAjaxLookupRetriever implements Component
{
	public function __construct($estate_agent_id)
	{
		$this->estate_agent_id = $estate_agent_id;
	}
	
	public function execute()
	{
		$lookup_contact_estate_agents = DB::table('contact_estate_agent')
			->leftJoin('contacts', 'contacts.id', '=' ,'contact_estate_agent.contact_id')
			->where('contact_estate_agent.estate_agent_id', '=', $this->estate_agent_id)
			->select('contacts.id',
					'contacts.firstname',
					'contacts.surname')
					->get();
		$contact_estate_agents = array();
		foreach($lookup_contact_estate_agents as $contact_estate_agent)
		{
			$contact_estate_agents[$contact_estate_agent->id] = $contact_estate_agent->firstname . " " . $contact_estate_agent->surname;
		}
		return $contact_estate_agents;
	}
}