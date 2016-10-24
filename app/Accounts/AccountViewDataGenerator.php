<?php
namespace jericho\Accounts;

use jericho\PropertyFlip;
use jericho\Transaction;
use jericho\Account;

/**
 * This class generates account and transaction related data for a property flip. The data is built up using 
 * a multidimensional associative array as follows:
 * [$account_id => [$account, $transactions, $account_balance]]
 * 
 * The array item $transactions are the $account specific $transactions for the specific PropertyFlip.
 * 
 * This array is used to populate one of the tabs (Transactions) Property Flip View.
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-21
 *
 */
class AccountViewDataGenerator
{
	/**
	 * The method used to generate the data
	 * 
	 * @param bigInteger $property_flip_id
	 * @return unknown[][]
	 */
	public function generateData($property_flip_id)
	{
		$property_flip = PropertyFlip::find($property_flip_id);
		/* Get a distinct list of all accounts for a property flip from the Transaction model */
		$accounts = Transaction::where('property_flip_id', '=', $property_flip_id)
							->select('account_id')
							->distinct()
							->get();
		$account_transactions = array();
		/* For each of these account ids */
		foreach($accounts as $account)
		{
			/* Get the account */
			$account_model = Account::find($account['account_id']);
			/* Get the transactions for the account */
			$transactions = Transaction::where('property_flip_id', '=', $property_flip_id)
								->where('account_id', '=', $account['account_id'])
								->select('*')
								->get();
			/* Calculate the account balance */
			$account_balance_calculator = new AccountBalanceCalculator();
			$account_balance = $account_balance_calculator->calculate($account['account_id'], $transactions);
			$account_transactions[$account['account_id']] = array($account_model, $transactions, $account_balance);
		}
		return $account_transactions;
	}
}