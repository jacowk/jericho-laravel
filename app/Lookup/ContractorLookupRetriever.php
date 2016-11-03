<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\Contractor;

/**
 * A component for retrieving contractors to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class ContractorLookupRetriever implements Component
{
	public function execute()
	{
		$lookup_contractors = Contractor::all();
		$contractors = array();
		$contractors[-1] = "Select Contractor";
		foreach($lookup_contractors as $contractor)
		{
			$contractors[$contractor->id] = $contractor->name;
		}
		return $contractors;
	}
}