<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Unit test for testing Contractor functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-17
 *
 */
class ContractorTest extends TestCase
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
	 * Test logging in, and navigating to the Search Contractor page
	 *
	 * @return void
	 */
	public function testSearchContractor()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-contractor')
			->see('Search Contractors');
	}

	/**
	 * Test adding a contractor
	 */
	public function testAddContractor()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-contractor')
	
			->press('Add Contractor')
			->seePageIs('/add-contractor')
			->type('Test Contractor', 'name')
			->press('Add Contractor')
	
			->see('Contractor saved');
	}

	/**
	 * Test searching for a contractor
	 */
	public function testDoAddContractorThenSearchContractor()
	{
		$name = 'Test Contractor';
			
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-contractor')
	
			->press('Add Contractor')
			->type($name, 'name')
			->press('Add Contractor')
	
			->visit('/search-contractor')
			->type($name, 'name')
			->press('Search')
			->see($name);
	}

	/**
	 * Test adding a contractor
	 */
	public function testAddContractorThenViewContractor()
	{
		$name = 'Test Contractor';
			
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-contractor')
	
			->press('Add Contractor')
			->type($name, 'name')
			->press('Add Contractor')
	
			->visit('/search-contractor')
			->type($name, 'name')
			->press('Search')
			->see($name)
			->click('View')
			->see('View Contractor')
			->see($name);
	}

	/**
	 * Test adding a contractor
	 */
	public function testAddContractorThenViewContractorThenUpdateContractor()
	{
		$name = 'Test Contractor';
			
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-contractor')
	
			->press('Add Contractor')
			->type($name, 'name')
			->press('Add Contractor')
	
			->visit('/search-contractor')
			->type($name, 'name')
			->press('Search')
			->see($name)
			->click('View')
	
			->press('Update Contractor')
			->see('Update Contractor')
			->see($name)
	
			->type($name . ' Updated', 'name')
			->press('Update Contractor')
			->see('Contractor updated')
			->see($name . ' Updated');
	}

	/**
	 * Test searching for a contractor
	 */
	public function testAddContractorThenSearchContractorThenUpdateContractor()
	{
		$name = 'Test Contractor';

		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-contractor')
	
			->press('Add Contractor')
			->type($name, 'name')
			->press('Add Contractor')
	
			->visit('/search-contractor')
			->type($name, 'name')
			->press('Search')
			->see($name)
	
			->click('Update')
			->see('Update Contractor')
			->see($name)
				
			->type($name . ' Updated', 'name')
			->press('Update Contractor')
			->see('Contractor updated')
			->see($name . ' Updated');
	}
}
