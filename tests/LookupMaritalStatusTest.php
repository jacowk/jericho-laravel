<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Unit test for testing Marital Status functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-18
 *
 */
class LookupMaritalStatusTest extends TestCase
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
	 * Test logging in, and navigating to the Search Marital Status page
	 *
	 * @return void
	 */
	public function testSearchLookupMaritalStatus()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-marital-status')
			->see('Search Marital Statuses');
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddLookupMaritalStatus()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-marital-status')
		
			->press('Add Marital Status')
			->seePageIs('/add-marital-status')
			->type('Test Marital Status 1000', 'description')
			->press('Add Marital Status')
		
			->see('Marital Status saved');
	}
	
	/**
	 * Test searching for a title
	 */
	public function testDoAddLookupMaritalStatusThenSearchLookupMaritalStatus()
	{
		$description = 'Test Marital Status 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-marital-status')
		
			->press('Add Marital Status')
			->type($description, 'description')
			->press('Add Marital Status')
		
			->visit('/search-marital-status')
			->type($description, 'description')
			->press('Search')
			->see($description);
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddLookupMaritalStatusThenViewLookupMaritalStatus()
	{
		$description = 'Test Marital Status 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-marital-status')
		
			->press('Add Marital Status')
			->type($description, 'description')
			->press('Add Marital Status')
		
			->visit('/search-marital-status')
			->type($description, 'description')
			->press('Search')
			->see($description)
			->click('View')
			->see('View Marital Status')
			->see($description);
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddLookupMaritalStatusThenViewLookupMaritalStatusThenUpdateLookupMaritalStatus()
	{
		$description = 'Test Marital Status 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-marital-status')
		
			->press('Add Marital Status')
			->type($description, 'description')
			->press('Add Marital Status')
		
			->visit('/search-marital-status')
			->type($description, 'description')
			->press('Search')
			->see($description)
			->click('View')
		
			->press('Update Marital Status')
			->see('Update Marital Status')
			->see($description)
			 
			->type($description . ' Updated', 'description')
			->press('Update Marital Status')
			->see('Marital Status updated')
			->see($description . ' Updated');
	}
	
	/**
	 * Test searching for a title
	 */
	public function testAddLookupMaritalStatusThenSearchLookupMaritalStatusThenUpdateLookupMaritalStatus()
	{
		$description = 'Test Marital Status 1000';
	
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-marital-status')
		
			->press('Add Marital Status')
			->type($description, 'description')
			->press('Add Marital Status')
		
			->visit('/search-marital-status')
			->type($description, 'description')
			->press('Search')
			->see($description)
		
			->click('Update')
			->see('Update Marital Status')
			->see($description)
			
			->type($description . ' Updated', 'description')
			->press('Update Marital Status')
			->see('Marital Status updated')
			->see($description . ' Updated');
	}
}
