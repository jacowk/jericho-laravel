<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Unit test for testing Account functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-18
 *
 */
class AccountTest extends TestCase
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
	 * Test logging in, and navigating to the Search Account page
	 *
	 * @return void
	 */
	public function testSearchAccount()
	{
		$this->visit('/')
		->visit('/login')
		->type('jaco.wk@gmail.com', 'email')
		->type('password', 'password')
		->press('Login')
		->visit('/search-account')
		->see('Search Accounts');
	}

	/**
	 * Test adding a account
	 */
	public function testAddAccount()
	{
		$this->visit('/')
		->visit('/login')
		->type('jaco.wk@gmail.com', 'email')
		->type('password', 'password')
		->press('Login')
		->visit('/search-account')

		->press('Add Account')
		->seePageIs('/add-account')
		->type('Test Account', 'name')
		->press('Add Account')

		->see('Account saved');
	}

	/**
	 * Test searching for a account
	 */
	public function testDoAddAccountThenSearchAccount()
	{
		$name = 'Test Account';
			
		$this->visit('/')
		->visit('/login')
		->type('jaco.wk@gmail.com', 'email')
		->type('password', 'password')
		->press('Login')
		->visit('/search-account')

		->press('Add Account')
		->type($name, 'name')
		->press('Add Account')

		->visit('/search-account')
		->type($name, 'name')
		->press('Search')
		->see($name);
	}

	/**
	 * Test adding a account
	 */
	public function testAddAccountThenViewAccount()
	{
		$name = 'Test Account';
			
		$this->visit('/')
		->visit('/login')
		->type('jaco.wk@gmail.com', 'email')
		->type('password', 'password')
		->press('Login')
		->visit('/search-account')

		->press('Add Account')
		->type($name, 'name')
		->press('Add Account')

		->visit('/search-account')
		->type($name, 'name')
		->press('Search')
		->see($name)
		->click('View')
		->see('View Account')
		->see($name);
	}

	/**
	 * Test adding a account
	 */
	public function testAddAccountThenViewAccountThenUpdateAccount()
	{
		$name = 'Test Account';
			
		$this->visit('/')
		->visit('/login')
		->type('jaco.wk@gmail.com', 'email')
		->type('password', 'password')
		->press('Login')
		->visit('/search-account')

		->press('Add Account')
		->type($name, 'name')
		->press('Add Account')

		->visit('/search-account')
		->type($name, 'name')
		->press('Search')
		->see($name)
		->click('View')

		->press('Update Account')
		->see('Update Account')
		->see($name)

		->type($name . ' Updated', 'name')
		->press('Update Account')
		->see('Account updated')
		->see($name . ' Updated');
	}

	/**
	 * Test searching for a account
	 */
	public function testAddAccountThenSearchAccountThenUpdateAccount()
	{
		$name = 'Test Account';

		$this->visit('/')
		->visit('/login')
		->type('jaco.wk@gmail.com', 'email')
		->type('password', 'password')
		->press('Login')
		->visit('/search-account')

		->press('Add Account')
		->type($name, 'name')
		->press('Add Account')

		->visit('/search-account')
		->type($name, 'name')
		->press('Search')
		->see($name)

		->click('Update')
		->see('Update Account')
		->see($name)
			
		->type($name . ' Updated', 'name')
		->press('Update Account')
		->see('Account updated')
		->see($name . ' Updated');
	}
}
