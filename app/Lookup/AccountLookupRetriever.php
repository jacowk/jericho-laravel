<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\Account;

/**
 * A component for retrieving accounts to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class AccountLookupRetriever implements Component
{
	public function execute()
	{
		$lookup_accounts = Account::all();
		$accounts = array();
		$accounts[-1] = "Select Account";
		foreach($lookup_accounts as $account)
		{
			$accounts[$account->id] = $account->name;
		}
		return $accounts;
	}
}