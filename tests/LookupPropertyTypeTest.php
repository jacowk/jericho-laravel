<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Unit test for testing Property Type functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-18
 *
 */
class LookupPropertyTypeTest extends AbstractUnitTest
{
    /**
	 * Test logging in, and navigating to the Search Property Type page
	 *
	 * @return void
	 */
	public function testSearchLookupPropertyType()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-property-type')
			->see('Search Property Types');
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddLookupPropertyType()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-property-type')
		
			->press('Add Property Type')
			->seePageIs('/add-property-type')
			->type('Test Property Type 1000', 'description')
			->press('Add Property Type')
		
			->see('Property Type saved');
	}
	
	/**
	 * Test searching for a title
	 */
	public function testDoAddLookupPropertyTypeThenSearchLookupPropertyType()
	{
		$description = 'Test Property Type 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-property-type')
		
			->press('Add Property Type')
			->type($description, 'description')
			->press('Add Property Type')
		
			->visit('/search-property-type')
			->type($description, 'description')
			->press('Search')
			->see($description);
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddLookupPropertyTypeThenViewLookupPropertyType()
	{
		$description = 'Test Property Type 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-property-type')
		
			->press('Add Property Type')
			->type($description, 'description')
			->press('Add Property Type')
		
			->visit('/search-property-type')
			->type($description, 'description')
			->press('Search')
			->see($description)
			->click('View')
			->see('View Property Type')
			->see($description);
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddLookupPropertyTypeThenViewLookupPropertyTypeThenUpdateLookupPropertyType()
	{
		$description = 'Test Property Type 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-property-type')
		
			->press('Add Property Type')
			->type($description, 'description')
			->press('Add Property Type')
		
			->visit('/search-property-type')
			->type($description, 'description')
			->press('Search')
			->see($description)
			->click('View')
		
			->press('Update Property Type')
			->see('Update Property Type')
			->see($description)
			 
			->type($description . ' Updated', 'description')
			->press('Update Property Type')
			->see('Property Type updated')
			->see($description . ' Updated');
	}
	
	/**
	 * Test searching for a title
	 */
	public function testAddLookupPropertyTypeThenSearchLookupPropertyTypeThenUpdateLookupPropertyType()
	{
		$description = 'Test Property Type 1000';
	
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-property-type')
		
			->press('Add Property Type')
			->type($description, 'description')
			->press('Add Property Type')
		
			->visit('/search-property-type')
			->type($description, 'description')
			->press('Search')
			->see($description)
		
			->click('Update')
			->see('Update Property Type')
			->see($description)
			
			->type($description . ' Updated', 'description')
			->press('Update Property Type')
			->see('Property Type updated')
			->see($description . ' Updated');
	}
}
