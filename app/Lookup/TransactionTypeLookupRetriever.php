<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\LookupTransactionType;

/**
 * A component for retrieving transaction types to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class TransactionTypeLookupRetriever implements Component
{
	public function execute()
	{
		$lookup_transaction_types = LookupTransactionType::all();
		$transaction_types = array();
		$transaction_types[-1] = "Select Transaction Type";
		foreach($lookup_transaction_types as $transaction_type)
		{
			$transaction_types[$transaction_type->id] = $transaction_type->description;
		}
		return $transaction_types;
	}
}