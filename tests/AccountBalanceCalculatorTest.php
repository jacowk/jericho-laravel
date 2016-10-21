<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Accounts\AccountBalanceCalculator;

/**
 * Unit test for AccountBalanceCalculator
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-21
 *
 */
class AccountBalanceCalculatorTest extends TestCase
{
    /**
     * Test calculate method
     *
     * @return void
     */
    public function testCalculate()
    {
    	$account_id = 1;
    	$transactions = array();
    	
    	/* Transaction 1 */
    	$transaction = array();
    	$transaction->account_id = 1;
    	$transaction->debit_amount = 10000000;
    	$transaction->credit_amount = 0;
    	array_push($transactions, $transaction);
    	
    	/* Transaction 2 */
    	$transaction = array();
    	$transaction->account_id = 1;
    	$transaction->debit_amount = 0;
    	$transaction->credit_amount = 25000000;
    	array_push($transactions, $transaction);
    	
    	$accountBalanceCalculator = new AccountBalanceCalculator();
    	$actual = $accountBalanceCalculator->calculate($account_id, $transactions);
    	$expected = 15000000;
    	$this->assertEquals($expected, $actual);
    }
}
