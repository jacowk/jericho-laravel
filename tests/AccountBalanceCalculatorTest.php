<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Accounts\AccountBalanceCalculator;
use jericho\Transaction;

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
    public function testCalculateWithValidData()
    {
    	$account_id = 1;
    	$transactions = array();
    	
    	/* Transaction 1 */
    	$transaction = new Transaction();
    	$transaction->account_id = 1;
    	$transaction->debit_amount = 10000000;
    	$transaction->credit_amount = 0;
    	array_push($transactions, $transaction);
    	
    	/* Transaction 2 */
    	$transaction2 = new Transaction();
    	$transaction2->account_id = 1;
    	$transaction2->debit_amount = 0;
    	$transaction2->credit_amount = 25000000;
    	array_push($transactions, $transaction2);
    	
    	$actual = (new AccountBalanceCalculator())->calculate($account_id, $transactions);
    	$expected = 15000000;
    	$this->assertEquals($expected, $actual);
    }
    
    /**
     * Test calculate method
     *
     * @return void
     */
    public function testCalculateWithDifferentAccountIds()
    {
    	$account_id = 1;
    	$transactions = array();
    	
    	/* Transaction 1 */
    	$transaction = new Transaction();
    	$transaction->account_id = 1;
    	$transaction->debit_amount = 10000000;
    	$transaction->credit_amount = 0;
    	array_push($transactions, $transaction);
    	
    	/* Transaction 2 */
    	$transaction2 = new Transaction();
    	$transaction2->account_id = 1;
    	$transaction2->debit_amount = 0;
    	$transaction2->credit_amount = 25000000;
    	array_push($transactions, $transaction2);
    	
    	/* Transaction 2 */
    	$transaction2 = new Transaction();
    	$transaction2->account_id = 2; /* Different account id */
    	$transaction2->debit_amount = 0;
    	$transaction2->credit_amount = 25000000;
    	array_push($transactions, $transaction2);
    	
    	$actual = (new AccountBalanceCalculator())->calculate($account_id, $transactions);
    	$expected = 15000000;
    	$this->assertEquals($expected, $actual);
    }
    
    /**
     * Test calculate method
     *
     * @return void
     */
    public function testCalculateWithNullCreditAmount()
    {
    	$account_id = 1;
    	$transactions = array();
    	
    	/* Transaction 1 */
    	$transaction = new Transaction();
    	$transaction->account_id = 1;
    	$transaction->debit_amount = 10000000;
    	$transaction->credit_amount = 0;
    	array_push($transactions, $transaction);
    	
    	/* Transaction 2 */
    	$transaction2 = new Transaction();
    	$transaction2->account_id = 1;
    	$transaction2->debit_amount = 0;
    	$transaction2->credit_amount = null;
    	array_push($transactions, $transaction2);
    	
    	$actual = (new AccountBalanceCalculator())->calculate($account_id, $transactions);
    	$expected = -10000000;
    	$this->assertEquals($expected, $actual);
    }
    
    /**
     * Test calculate method
     *
     * @return void
     */
    public function testCalculateWithNullDebitAmount()
    {
    	$account_id = 1;
    	$transactions = array();
    	
    	/* Transaction 1 */
    	$transaction = new Transaction();
    	$transaction->account_id = 1;
    	$transaction->debit_amount = null;
    	$transaction->credit_amount = 0;
    	array_push($transactions, $transaction);
    	
    	/* Transaction 2 */
    	$transaction2 = new Transaction();
    	$transaction2->account_id = 1;
    	$transaction2->debit_amount = 0;
    	$transaction2->credit_amount = 25000000;
    	array_push($transactions, $transaction2);
    	
    	$actual = (new AccountBalanceCalculator())->calculate($account_id, $transactions);
    	$expected = 25000000;
    	$this->assertEquals($expected, $actual);
    }
    
    /**
     * Test calculate method
     *
     * @return void
     */
    public function testCalculateWithEmptyTransactionsData()
    {
    	$account_id = 1;
    	$transactions = array();
    	$actual = (new AccountBalanceCalculator())->calculate($account_id, $transactions);
    	$expected = 0;
    	$this->assertEquals($expected, $actual);
    }
    
    /**
     * Test calculate method
     *
     * @return void
     */
    public function testCalculateWithNullTransactionsData()
    {
    	$account_id = 1;
    	$transactions = null;
    	$actual = (new AccountBalanceCalculator())->calculate($account_id, $transactions);
    	$expected = 0;
    	$this->assertEquals($expected, $actual);
    }
}
