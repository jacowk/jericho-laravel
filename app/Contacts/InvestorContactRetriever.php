<?php
namespace jericho\Contacts;

use jericho\Component\Component;
use DB;

/**
 * This component is used to retrieve contacts for investors by property flip.
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class InvestorContactRetriever implements Component
{
	public function __construct($property_flip)
	{
		$this->property_flip = $property_flip;
	}

	public function execute()
	{
		$contact_investors = DB::table('investor_property_flip')
						->join('contacts', 'contacts.id', '=' ,'investor_property_flip.contact_id')
						->join('property_flips', 'property_flips.id', '=', 'investor_property_flip.property_flip_id')
						->where('investor_property_flip.property_flip_id', '=', $this->property_flip->id)
						->select('contacts.firstname as contact_firstname',
								'contacts.surname as contact_surname',
								'contacts.work_email as contact_work_email',
								'contacts.work_tel_no as contact_work_tel_no',
								'contacts.cell_no as contact_cell_no',
								'contacts.id as contact_id',
								'investor_property_flip.investment_amount')
								->get();
		return $contact_investors;
	}
}