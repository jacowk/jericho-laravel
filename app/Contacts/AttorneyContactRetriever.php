<?php
namespace jericho\Contacts;

use jericho\Component\Component;
use DB;

/**
 * This component is used to retrieve contacts for attorneys by property flip.
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class AttorneyContactRetriever implements Component
{
	public function __construct($property_flip)
	{
		$this->property_flip = $property_flip;
	}

	public function execute()
	{
		$attorney_contacts = DB::table('attorney_property_flip')
						->join('contacts', 'contacts.id', '=' ,'attorney_property_flip.contact_id')
						->join('property_flips', 'property_flips.id', '=', 'attorney_property_flip.property_flip_id')
						->join('attorney_contact', 'attorney_contact.contact_id', '=', 'contacts.id')
						->join('attorneys', 'attorneys.id', '=', 'attorney_contact.attorney_id')
						->join('lookup_attorney_types', 'lookup_attorney_types.id', '=', 'attorney_property_flip.lookup_attorney_type_id')
						->where('attorney_property_flip.property_flip_id', '=', $this->property_flip->id)
						->select('attorneys.name as attorney_name', 
								'contacts.firstname as contact_firstname',
								'contacts.surname as contact_surname',
								'contacts.work_email as contact_work_email',
								'contacts.work_tel_no as contact_work_tel_no',
								'contacts.cell_no as contact_cell_no',
								'lookup_attorney_types.description as lookup_attorney_type',
								'lookup_attorney_types.id as lookup_attorney_type_id',
								'contacts.id as contact_id')
						->get();
		return $attorney_contacts;
	}
}