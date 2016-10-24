<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Accounts\AccountViewDataGenerator;

/**
 * The test case for AccountViewDataGenerator.
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-21
 * 
 */
class AccountViewDataGeneratorTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGenerateData()
    {
    	$property_flip_id = 1;
    	$accountViewDataGenerator = new AccountViewDataGenerator();
    	$account_transactions = $accountViewDataGenerator->generateData($property_flip_id);
    	print_r($account_transactions);
    }
}
