<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\Attorney;
use DB;

/**
 * A component for retrieving attorney contacts for ajax to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class AttorneyContactAjaxLookupRetriever implements Component
{
	public function __construct($attorney_id)
	{
		$this->attorney_id = $attorney_id;
	}
	
	public function execute()
	{
		$lookup_attorney_contacts = DB::table('attorney_contact')
			->leftJoin('contacts', 'contacts.id', '=' ,'attorney_contact.contact_id')
			->where('attorney_contact.attorney_id', '=', $this->attorney_id)
			->select('contacts.id',
					'contacts.firstname',
					'contacts.surname')
					->get();
		$attorney_contacts = array();
		foreach($lookup_attorney_contacts as $attorney_contact)
		{
			$attorney_contacts[$attorney_contact->id] = $attorney_contact->firstname . " " . $attorney_contact->surname;
		}
		return $attorney_contacts;
	}
}