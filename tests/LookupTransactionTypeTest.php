<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Unit test for testing Transaction Type functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-18
 *
 */
class LookupTransactionTypeTest extends TestCase
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
	
	/**
	 * Test logging in, and navigating to the Search Transaction Type page
	 *
	 * @return void
	 */
	public function testSearchLookupTransactionType()
	{
		$this->visit('/')
		->visit('/login')
		->type('jaco.wk@gmail.com', 'email')
		->type('password', 'password')
		->press('Login')
		->visit('/search-transaction-type')
		->see('Search Transaction Types');
	}

	/**
	 * Test adding a title
	 */
	public function testAddLookupTransactionType()
	{
		$this->visit('/')
		->visit('/login')
		->type('jaco.wk@gmail.com', 'email')
		->type('password', 'password')
		->press('Login')
		->visit('/search-transaction-type')

		->press('Add Transaction Type')
		->seePageIs('/add-transaction-type')
		->type('Test Transaction Type 1000', 'description')
		->press('Add Transaction Type')

		->see('Transaction Type saved');
	}

	/**
	 * Test searching for a title
	 */
	public function testDoAddLookupTransactionTypeThenSearchLookupTransactionType()
	{
		$description = 'Test Transaction Type 1000';
			
		$this->visit('/')
		->visit('/login')
		->type('jaco.wk@gmail.com', 'email')
		->type('password', 'password')
		->press('Login')
		->visit('/search-transaction-type')

		->press('Add Transaction Type')
		->type($description, 'description')
		->press('Add Transaction Type')

		->visit('/search-transaction-type')
		->type($description, 'description')
		->press('Search')
		->see($description);
	}

	/**
	 * Test adding a title
	 */
	public function testAddLookupTransactionTypeThenViewLookupTransactionType()
	{
		$description = 'Test Transaction Type 1000';
			
		$this->visit('/')
		->visit('/login')
		->type('jaco.wk@gmail.com', 'email')
		->type('password', 'password')
		->press('Login')
		->visit('/search-transaction-type')

		->press('Add Transaction Type')
		->type($description, 'description')
		->press('Add Transaction Type')

		->visit('/search-transaction-type')
		->type($description, 'description')
		->press('Search')
		->see($description)
		->click('View')
		->see('View Transaction Type')
		->see($description);
	}

	/**
	 * Test adding a title
	 */
	public function testAddLookupTransactionTypeThenViewLookupTransactionTypeThenUpdateLookupTransactionType()
	{
		$description = 'Test Transaction Type 1000';
			
		$this->visit('/')
		->visit('/login')
		->type('jaco.wk@gmail.com', 'email')
		->type('password', 'password')
		->press('Login')
		->visit('/search-transaction-type')

		->press('Add Transaction Type')
		->type($description, 'description')
		->press('Add Transaction Type')

		->visit('/search-transaction-type')
		->type($description, 'description')
		->press('Search')
		->see($description)
		->click('View')

		->press('Update Transaction Type')
		->see('Update Transaction Type')
		->see($description)

		->type($description . ' Updated', 'description')
		->press('Update Transaction Type')
		->see('Transaction Type updated')
		->see($description . ' Updated');
	}

	/**
	 * Test searching for a title
	 */
	public function testAddLookupTransactionTypeThenSearchLookupTransactionTypeThenUpdateLookupTransactionType()
	{
		$description = 'Test Transaction Type 1000';

		$this->visit('/')
		->visit('/login')
		->type('jaco.wk@gmail.com', 'email')
		->type('password', 'password')
		->press('Login')
		->visit('/search-transaction-type')

		->press('Add Transaction Type')
		->type($description, 'description')
		->press('Add Transaction Type')

		->visit('/search-transaction-type')
		->type($description, 'description')
		->press('Search')
		->see($description)

		->click('Update')
		->see('Update Transaction Type')
		->see($description)
			
		->type($description . ' Updated', 'description')
		->press('Update Transaction Type')
		->see('Transaction Type updated')
		->see($description . ' Updated');
	}
}
