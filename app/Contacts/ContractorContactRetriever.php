<?php
namespace jericho\Contacts;

use jericho\Component\Component;
use DB;
use Exception;

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
		if ($this->property_flip == null)
		{
			throw new Exception('A property flip must be provided to retrieve contacts for contractors for a property flip');
		}
		$contact_contractors = DB::table('contractor_property_flip')
						->leftJoin('contacts', 'contacts.id', '=' ,'contractor_property_flip.contact_id')
						->leftJoin('property_flips', 'property_flips.id', '=', 'contractor_property_flip.property_flip_id')
						->leftJoin('contact_contractor', 'contact_contractor.contact_id', '=', 'contacts.id')
						->leftJoin('contractors', 'contractors.id', '=', 'contact_contractor.contractor_id')
						->leftJoin('lookup_contractor_types', 'lookup_contractor_types.id', '=', 'contractor_property_flip.lookup_contractor_type_id')
						->leftJoin('lookup_titles', 'lookup_titles.id', '=', 'contacts.title_id')
						->where('contractor_property_flip.property_flip_id', '=', $this->property_flip->id)
						->select('contractors.name as contractor_name',
								'lookup_titles.description as contact_title',
								'contacts.firstname as contact_firstname',
								'contacts.surname as contact_surname',
								
								'contacts.home_tel_no as contact_home_tel_no',
								'contacts.work_tel_no as contact_work_tel_no',
								'contacts.cell_no as contact_cell_no',
								'contacts.fax_no as contact_fax_no',
								'contacts.personal_email as contact_personal_email',
								'contacts.work_email as contact_work_email',
								
								'lookup_contractor_types.description as lookup_contractor_type',
								'lookup_contractor_types.id as lookup_contractor_type_id',
								'contacts.id as contact_id')
								->get();
		return $contact_contractors;
	}
}