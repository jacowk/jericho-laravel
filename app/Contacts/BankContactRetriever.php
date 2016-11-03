<?php
namespace jericho\Contacts;

use jericho\Component\Component;
use DB;

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
		$contact_banks = DB::table('bank_property_flip')
						->join('contacts', 'contacts.id', '=' ,'bank_property_flip.contact_id')
						->join('property_flips', 'property_flips.id', '=', 'bank_property_flip.property_flip_id')
						->join('bank_contact', 'bank_contact.contact_id', '=', 'contacts.id')
						->join('banks', 'banks.id', '=', 'bank_contact.bank_id')
						->where('bank_property_flip.property_flip_id', '=', $this->property_flip->id)
						->select('banks.name as bank_name',
								'contacts.firstname as contact_firstname',
								'contacts.surname as contact_surname',
								'contacts.work_email as contact_work_email',
								'contacts.work_tel_no as contact_work_tel_no',
								'contacts.cell_no as contact_cell_no',
								'contacts.id as contact_id')
								->get();
		return $contact_banks;
	}
}