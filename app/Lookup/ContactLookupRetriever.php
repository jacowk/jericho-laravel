<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\Contact;

/**
 * A component for retrieving contacts to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class ContactLookupRetriever implements Component
{
	public function execute()
	{
		$table_contacts = Contact::all();
		$contacts = array();
		$contacts[-1] = "Select Contact";
		foreach($table_contacts as $contact)
		{
			$contacts[$contact->id] = $contact->firstname . " " . $contact->surname;
		}
		return $contacts;
	}
}