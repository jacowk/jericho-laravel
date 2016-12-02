<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use DB;

/**
 * A component for retrieving contacts for contractors for ajax to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class ContactContractorAjaxLookupRetriever implements Component
{
	public function __construct($contractor_id)
	{
		$this->contractor_id = $contractor_id;
	}
	
	public function execute()
	{
		$lookup_contact_contractors = DB::table('contact_contractor')
			->leftJoin('contacts', 'contacts.id', '=' ,'contact_contractor.contact_id')
			->where('contact_contractor.contractor_id', '=', $this->contractor_id)
			->select('contacts.id',
					'contacts.firstname',
					'contacts.surname')
					->get();
		$contact_contractors = array();
		foreach($lookup_contact_contractors as $contact_contractor)
		{
			$contact_contractors[$contact_contractor->id] = $contact_contractor->firstname . " " . $contact_contractor->surname;
		}
		return $contact_contractors;
	}
}