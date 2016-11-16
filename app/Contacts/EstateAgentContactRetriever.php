<?php
namespace jericho\Contacts;

use jericho\Component\Component;
use DB;
use Exception;

/**
 * This component is used to retrieve contacts for estate agents by property flip.
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class EstateAgentContactRetriever implements Component
{
	public function __construct($property_flip)
	{
		$this->property_flip = $property_flip;
	}

	public function execute()
	{
		if ($this->property_flip == null)
		{
			throw new Exception('A property flip must be provided to retrieve contacts for estate agents for a property flip');
		}
		$contact_estate_agents = DB::table('estate_agent_property_flip')
						->join('contacts', 'contacts.id', '=' ,'estate_agent_property_flip.contact_id')
						->join('property_flips', 'property_flips.id', '=', 'estate_agent_property_flip.property_flip_id')
						->join('contact_estate_agent', 'contact_estate_agent.contact_id', '=', 'contacts.id')
						->join('estate_agents', 'estate_agents.id', '=', 'contact_estate_agent.estate_agent_id')
						->join('lookup_estate_agent_types', 'lookup_estate_agent_types.id', '=', 'estate_agent_property_flip.lookup_estate_agent_type_id')
						->where('estate_agent_property_flip.property_flip_id', '=', $this->property_flip->id)
						->select('estate_agents.name as estate_agent_name',
								'contacts.firstname as contact_firstname',
								'contacts.surname as contact_surname',
								'contacts.work_email as contact_work_email',
								'contacts.work_tel_no as contact_work_tel_no',
								'contacts.cell_no as contact_cell_no',
								'lookup_estate_agent_types.description as lookup_estate_agent_type',
								'lookup_estate_agent_types.id as lookup_estate_agent_type_id',
								'contacts.id as contact_id')
								->get();
		return $contact_estate_agents;
	}
}