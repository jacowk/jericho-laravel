<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\LookupContractorType;

/**
 * A component for retrieving contractor types to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-02
 *
 */
class ContractorTypeLookupRetriever implements Component
{
	public function execute()
	{
		$lookup_contractor_types = LookupContractorType::all();
		$contractor_types = array();
		$contractor_types[-1] = "Select Contractor Type";
		foreach($lookup_contractor_types as $contractor_type)
		{
			$contractor_types[$contractor_type->id] = $contractor_type->description;
		}
		return $contractor_types;
	}
}