<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use DB;

/**
 * A component for retrieving bank contacts for ajax to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class BankContactAjaxLookupRetriever implements Component
{
	public function __construct($bank_id)
	{
		$this->bank_id = $bank_id;
	}
	
	public function execute()
	{
		$lookup_bank_contacts = DB::table('bank_contact')
				->join('contacts', 'contacts.id', '=' ,'bank_contact.contact_id')
				->where('bank_contact.bank_id', '=', $this->bank_id)
				->select('contacts.id',
						'contacts.firstname',
						'contacts.surname')
						->get();
		$bank_contacts = array();
		foreach($lookup_bank_contacts as $bank_contact)
		{
			$bank_contacts[$bank_contact->id] = $bank_contact->firstname . " " . $bank_contact->surname;
		}
		return $bank_contacts;
	}
}