<?php
namespace jericho\Contacts;

use jericho\Component\Component;
use DB;

/**
 * This component is used to retrieve contacts for contractors by property flip.
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class ContractorContactRetriever implements Component
{
	public function __construct($property_flip)
	{
		$this->property_flip = $property_flip;
	}

	public function execute()
	{
		$contact_contractors = DB::table('contractor_property_flip')
						->join('contacts', 'contacts.id', '=' ,'contractor_property_flip.contact_id')
						->join('property_flips', 'property_flips.id', '=', 'contractor_property_flip.property_flip_id')
						->join('contact_contractor', 'contact_contractor.contact_id', '=', 'contacts.id')
						->join('contractors', 'contractors.id', '=', 'contact_contractor.contractor_id')
						->join('lookup_contractor_types', 'lookup_contractor_types.id', '=', 'contractor_property_flip.lookup_contractor_type_id')
						->where('contractor_property_flip.property_flip_id', '=', $this->property_flip->id)
						->select('contractors.name as contractor_name',
								'contacts.firstname as contact_firstname',
								'contacts.surname as contact_surname',
								'contacts.work_email as contact_work_email',
								'contacts.work_tel_no as contact_work_tel_no',
								'contacts.cell_no as contact_cell_no',
								'lookup_contractor_types.description as lookup_contractor_type',
								'lookup_contractor_types.id as lookup_contractor_type_id',
								'contacts.id as contact_id')
								->get();
		return $contact_contractors;
	}
}