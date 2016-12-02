<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use DB;

/**
 * A component for retrieving types for contractor services for ajax to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class ContractorServiceTypeAjaxLookupRetriever implements Component
{
	public function __construct($contractor_id)
	{
		$this->contractor_id = $contractor_id;
	}
	
	public function execute()
	{
		$lookup_contact_contractors = DB::table('contractor_services')
				->leftJoin('lookup_contractor_types', 'lookup_contractor_types.id', '=', 'contractor_services.contractor_type_id')
				->where('contractor_services.contractor_id', '=', $this->contractor_id)
				->select('lookup_contractor_types.id', 'lookup_contractor_types.description')
				->get();
		$contact_contractors = array();
		foreach($lookup_contact_contractors as $contact_contractor)
		{
			$contact_contractors[$contact_contractor->id] = $contact_contractor->description;
		}
		return $contact_contractors;
	}
}