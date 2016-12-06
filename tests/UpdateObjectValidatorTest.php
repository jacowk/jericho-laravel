<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Validation\UpdateObjectValidator;
use jericho\Account;
use Carbon\Carbon;

/**
 * A test class for testing UpdateObjectValidator
 * 
 * @author Jaco Koekemoer
 * Date: 2016-12-05
 *
 */
class UpdateObjectValidatorTest extends TestCase
{
	public function setUp()
	{
		parent::setUp();
		$this->artisan('db:seed');
	}
	
	public function tearDown()
	{
		/* The following 3 lines of code are required to sort out the "Too many connections error" */
		$this->beforeApplicationDestroyed(function () {
			DB::disconnect();
		});
	
			parent::tearDown();
			// 		Mockery::close();
	}
	
	public function testValidateWithValidObject()
    {
    	$account_id = $this->createAccount();
    	$retrieved_account = Account::find($account_id);
    	try
    	{
    		(new UpdateObjectValidator())->validate($retrieved_account, "account", $account_id);
    	}
    	catch(Exception $e)
    	{
    		$this->fail("An exception must not be thrown here");
    	}
    }
    
    public function testValidateWithNullObject()
    {
    	$account_id = 1;
    	$retrieved_account = null;
    	try
    	{
    		(new UpdateObjectValidator())->validate($retrieved_account, "account", $account_id);
    		$this->fail("An exception must be thrown");
    	}
    	catch(Exception $e)
    	{
    		echo $e->getMessage();
    	}
    }
    
    private function createAccount()
    {
    	$account = new Account();
    	$account->name = "Validation Account";
    	$account->created_by_id = 1;
    	$account->created_at = new Carbon;
    	$account->save();
    	return $account->id;
    }
}
