<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\LookupMaritalStatus;

/**
 * A component for retrieving marital statuses to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-02
 *
 */
class MaritalStatusLookupRetriever implements Component
{
	public function execute()
	{
		$lookup_marital_statuses = LookupMaritalStatus::all();
		$marital_statuses = array();
		$marital_statuses[-1] = "Select Marital Status";
		foreach($lookup_marital_statuses as $marital_status)
		{
			$marital_statuses[$marital_status->id] = $marital_status->description;
		}
		return $marital_statuses;
	}
}