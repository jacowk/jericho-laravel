<?php
namespace jericho\Contacts;

use jericho\Component\Component;
use DB;
use Exception;

/**
 * This component is used to retrieve contacts for banks by property flip.
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class BankContactRetriever implements Component
{
	public function __construct($property_flip)
	{
		$this->property_flip = $property_flip;
	}

	public function execute()
	{
		if ($this->property_flip == null)
		{
			throw new Exception('A property flip must be provided to retrieve contacts for banks for a property flip');
		}
		$contact_banks = DB::table('bank_property_flip')
						->leftJoin('contacts', 'contacts.id', '=' ,'bank_property_flip.contact_id')
						->leftJoin('property_flips', 'property_flips.id', '=', 'bank_property_flip.property_flip_id')
						->leftJoin('bank_contact', 'bank_contact.contact_id', '=', 'contacts.id')
						->leftJoin('banks', 'banks.id', '=', 'bank_contact.bank_id')
						->leftJoin('lookup_titles', 'lookup_titles.id', '=', 'contacts.title_id')
						->where('bank_property_flip.property_flip_id', '=', $this->property_flip->id)
						->select('banks.name as bank_name',
								'lookup_titles.description as contact_title',
								'contacts.firstname as contact_firstname',
								'contacts.surname as contact_surname',
								'contacts.home_tel_no as contact_home_tel_no',
								'contacts.work_tel_no as contact_work_tel_no',
								'contacts.cell_no as contact_cell_no',
								'contacts.fax_no as contact_fax_no',
								'contacts.personal_email as contact_personal_email',
								'contacts.work_email as contact_work_email',
								'contacts.id as contact_id')
								->get();
		return $contact_banks;
	}
}