<?php
namespace jericho\Accounts;

use jericho\Util\Util;

/**
 * The purpose of this class is to calculate the balance on an a given account, provided with the account_id,
 * and the account transactions.
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-21
 *
 */
class AccountBalanceCalculator
{
	
	/**
	 * Calculate the balance on a given list of transactions, having the provided account id
	 * 
	 * @param number $account_id
	 * @param array $transactions
	 * @return number
	 */
	public function calculate($account_id, $transactions)
	{
		$account_balance = 0;
		if ($transactions)
		{
			foreach($transactions as $transaction)
			{
				if ($transaction->account_id === $account_id)
				{
					if (Util::isValidRequestVariable($transaction->debit_amount) && $transaction->debit_amount > 0)
					{
						$account_balance -= $transaction->debit_amount;
					}
					else if (Util::isValidRequestVariable($transaction->credit_amount) && $transaction->credit_amount > 0)
					{
						$account_balance += $transaction->credit_amount;
					}
				}
			}
		}
		return $account_balance;
	}
}