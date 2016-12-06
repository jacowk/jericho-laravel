<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Unit test for testing Contractor Type functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-18
 *
 */
class LookupContractorTypeTest extends TestCase
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
	 * Test logging in, and navigating to the Search Contractor Type page
	 *
	 * @return void
	 */
	public function testSearchLookupContractorType()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-contractor-type')
			->see('Search Contractor Types');
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddLookupContractorType()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-contractor-type')
		
			->press('Add Contractor Type')
			->seePageIs('/add-contractor-type')
			->type('Test Contractor Type 1000', 'description')
			->press('Add Contractor Type')
		
			->see('Contractor Type saved');
	}
	
	/**
	 * Test searching for a title
	 */
	public function testDoAddLookupContractorTypeThenSearchLookupContractorType()
	{
		$description = 'Test Contractor Type 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-contractor-type')
		
			->press('Add Contractor Type')
			->type($description, 'description')
			->press('Add Contractor Type')
		
			->visit('/search-contractor-type')
			->type($description, 'description')
			->press('Search')
			->see($description);
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddLookupContractorTypeThenViewLookupContractorType()
	{
		$description = 'Test Contractor Type 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-contractor-type')
		
			->press('Add Contractor Type')
			->type($description, 'description')
			->press('Add Contractor Type')
		
			->visit('/search-contractor-type')
			->type($description, 'description')
			->press('Search')
			->see($description)
			->click('View')
			->see('View Contractor Type')
			->see($description);
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddLookupContractorTypeThenViewLookupContractorTypeThenUpdateLookupContractorType()
	{
		$description = 'Test Contractor Type 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-contractor-type')
		
			->press('Add Contractor Type')
			->type($description, 'description')
			->press('Add Contractor Type')
		
			->visit('/search-contractor-type')
			->type($description, 'description')
			->press('Search')
			->see($description)
			->click('View')
		
			->press('Update Contractor Type')
			->see('Update Contractor Type')
			->see($description)
			 
			->type($description . ' Updated', 'description')
			->press('Update Contractor Type')
			->see('Contractor Type updated')
			->see($description . ' Updated');
	}
	
	/**
	 * Test searching for a title
	 */
	public function testAddLookupContractorTypeThenSearchLookupContractorTypeThenUpdateLookupContractorType()
	{
		$description = 'Test Contractor Type 1000';
	
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-contractor-type')
		
			->press('Add Contractor Type')
			->type($description, 'description')
			->press('Add Contractor Type')
		
			->visit('/search-contractor-type')
			->type($description, 'description')
			->press('Search')
			->see($description)
		
			->click('Update')
			->see('Update Contractor Type')
			->see($description)
			
			->type($description . ' Updated', 'description')
			->press('Update Contractor Type')
			->see('Contractor Type updated')
			->see($description . ' Updated');
	}
}
