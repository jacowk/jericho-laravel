<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Unit test for testing Attorney Type functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-18
 *
 */
class LookupAttorneyTypeTest extends TestCase
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
	 * Test logging in, and navigating to the Search Attorney Type page
	 *
	 * @return void
	 */
	public function testSearchLookupAttorneyType()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-attorney-type')
			->see('Search Attorney Types');
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddLookupAttorneyType()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-attorney-type')
		
			->press('Add Attorney Type')
			->seePageIs('/add-attorney-type')
			->type('Test Attorney Type 1000', 'description')
			->press('Add Attorney Type')
		
			->see('Attorney Type saved');
	}
	
	/**
	 * Test searching for a title
	 */
	public function testDoAddLookupAttorneyTypeThenSearchLookupAttorneyType()
	{
		$description = 'Test Attorney Type 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-attorney-type')
		
			->press('Add Attorney Type')
			->type($description, 'description')
			->press('Add Attorney Type')
		
			->visit('/search-attorney-type')
			->type($description, 'description')
			->press('Search')
			->see($description);
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddLookupAttorneyTypeThenViewLookupAttorneyType()
	{
		$description = 'Test Attorney Type 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-attorney-type')
		
			->press('Add Attorney Type')
			->type($description, 'description')
			->press('Add Attorney Type')
		
			->visit('/search-attorney-type')
			->type($description, 'description')
			->press('Search')
			->see($description)
			->click('View')
			->see('View Attorney Type')
			->see($description);
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddLookupAttorneyTypeThenViewLookupAttorneyTypeThenUpdateLookupAttorneyType()
	{
		$description = 'Test Attorney Type 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-attorney-type')
		
			->press('Add Attorney Type')
			->type($description, 'description')
			->press('Add Attorney Type')
		
			->visit('/search-attorney-type')
			->type($description, 'description')
			->press('Search')
			->see($description)
			->click('View')
		
			->press('Update Attorney Type')
			->see('Update Attorney Type')
			->see($description)
			 
			->type($description . ' Updated', 'description')
			->press('Update Attorney Type')
			->see('Attorney Type updated')
			->see($description . ' Updated');
	}
	
	/**
	 * Test searching for a title
	 */
	public function testAddLookupAttorneyTypeThenSearchLookupAttorneyTypeThenUpdateLookupAttorneyType()
	{
		$description = 'Test Attorney Type 1000';
	
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-attorney-type')
		
			->press('Add Attorney Type')
			->type($description, 'description')
			->press('Add Attorney Type')
		
			->visit('/search-attorney-type')
			->type($description, 'description')
			->press('Search')
			->see($description)
		
			->click('Update')
			->see('Update Attorney Type')
			->see($description)
			
			->type($description . ' Updated', 'description')
			->press('Update Attorney Type')
			->see('Attorney Type updated')
			->see($description . ' Updated');
	}
}
