<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Unit test for testing Bank functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-17
 *
 */
class BankTest extends TestCase
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
	 * Test logging in, and navigating to the Search Bank page
	 *
	 * @return void
	 */
	public function testSearchBank()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-bank')
			->see('Search Banks');
	}

	/**
	 * Test adding a bank
	 */
	public function testAddBank()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-bank')
	
			->press('Add Bank')
			->seePageIs('/add-bank')
			->type('Test Bank', 'name')
			->press('Add Bank')
	
			->see('Bank saved');
	}

	/**
	 * Test searching for a bank
	 */
	public function testDoAddBankThenSearchBank()
	{
		$name = 'Test Bank';
			
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-bank')
	
			->press('Add Bank')
			->type($name, 'name')
			->press('Add Bank')
	
			->visit('/search-bank')
			->type($name, 'name')
			->press('Search')
			->see($name);
	}

	/**
	 * Test adding a bank
	 */
	public function testAddBankThenViewBank()
	{
		$name = 'Test Bank';
			
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-bank')
	
			->press('Add Bank')
			->type($name, 'name')
			->press('Add Bank')
	
			->visit('/search-bank')
			->type($name, 'name')
			->press('Search')
			->see($name)
			->click('View')
			->see('View Bank')
			->see($name);
	}

	/**
	 * Test adding a bank
	 */
	public function testAddBankThenViewBankThenUpdateBank()
	{
		$name = 'Test Bank';
			
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-bank')
	
			->press('Add Bank')
			->type($name, 'name')
			->press('Add Bank')
	
			->visit('/search-bank')
			->type($name, 'name')
			->press('Search')
			->see($name)
			->click('View')
	
			->press('Update Bank')
			->see('Update Bank')
			->see($name)
	
			->type($name . ' Updated', 'name')
			->press('Update Bank')
			->see('Bank updated')
			->see($name . ' Updated');
	}

	/**
	 * Test searching for a bank
	 */
	public function testAddBankThenSearchBankThenUpdateBank()
	{
		$name = 'Test Bank';

		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-bank')
	
			->press('Add Bank')
			->type($name, 'name')
			->press('Add Bank')
	
			->visit('/search-bank')
			->type($name, 'name')
			->press('Search')
			->see($name)
	
			->click('Update')
			->see('Update Bank')
			->see($name)
				
			->type($name . ' Updated', 'name')
			->press('Update Bank')
			->see('Bank updated')
			->see($name . ' Updated');
	}
}
