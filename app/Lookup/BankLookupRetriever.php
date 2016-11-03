<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\Bank;

/**
 * A component for retrieving banks to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class BankLookupRetriever implements Component
{
	public function execute()
	{
		$lookup_banks = Bank::all();
		$banks = array();
		$banks[-1] = "Select Bank";
		foreach($lookup_banks as $bank)
		{
			$banks[$bank->id] = $bank->name;
		}
		return $banks;
	}
}