<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Unit test for testing Property functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-18
 *
 */
class PropertyTest extends AbstractUnitTest
{
	/**
	 * Test logging in, and navigating to the Search Property page
	 *
	 * @return void
	 */
	public function testSearchProperty()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-property')
			->see('Search Propertys');
	}
	
	/**
	 * Test adding a property
	 */
	public function testAddProperty()
	{
		$address_line_1 = "Test address line 1000";
		$suburb_id = 1;
		$area_id = 1;
		$greater_area_id = 1;
		$portion_number = 1;
		$erf_number = 10;
		$size = 50;
		$lookup_property_type_id = 1;
		
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-property')
		
			->press('Add Property')
			->seePageIs('/add-property')
			->type($address_line_1, 'address_line_1')
			
			->type($portion_number, 'portion_number')
			->type($erf_number, 'erf_number')
			->type($size, 'size')
			->select($suburb_id, 'suburb_id')
			->select($area_id, 'area_id')
			->select($greater_area_id, 'greater_area_id')
			->select($lookup_property_type_id, 'lookup_property_type_id')
			
			->press('Add Property')
		
			->see('Property saved')
			->see($address_line_1)
			->see($suburb_id)
			->see($area_id)
			->see($greater_area_id)
			->see($portion_number)
			->see($erf_number)
			->see($size)
			->see($lookup_property_type_id);
	}
	
// 	/**
// 	 * Test searching for a property
// 	 */
// 	public function testDoAddPropertyThenSearchProperty()
// 	{
// 		$name = 'Test Property';
		 
// 		$this->visit('/')
// 			->visit('/login')
// 			->type('jaco.wk@gmail.com', 'email')
// 			->type('password', 'password')
// 			->press('Login')
// 			->visit('/search-property')
		
// 			->press('Add Property')
// 			->type($name, 'name')
// 			->press('Add Property')
		
// 			->visit('/search-property')
// 			->type($name, 'name')
// 			->press('Search')
// 			->see($name);
// 	}
	
// 	/**
// 	 * Test adding a property
// 	 */
// 	public function testAddPropertyThenViewProperty()
// 	{
// 		$name = 'Test Property';
		 
// 		$this->visit('/')
// 			->visit('/login')
// 			->type('jaco.wk@gmail.com', 'email')
// 			->type('password', 'password')
// 			->press('Login')
// 			->visit('/search-property')
		
// 			->press('Add Property')
// 			->type($name, 'name')
// 			->press('Add Property')
		
// 			->visit('/search-property')
// 			->type($name, 'name')
// 			->press('Search')
// 			->see($name)
// 			->click('View')
// 			->see('View Property')
// 			->see($name);
// 	}
	
// 	/**
// 	 * Test adding a property
// 	 */
// 	public function testAddPropertyThenViewPropertyThenUpdateProperty()
// 	{
// 		$name = 'Test Property';
		 
// 		$this->visit('/')
// 			->visit('/login')
// 			->type('jaco.wk@gmail.com', 'email')
// 			->type('password', 'password')
// 			->press('Login')
// 			->visit('/search-property')
		
// 			->press('Add Property')
// 			->type($name, 'name')
// 			->press('Add Property')
		
// 			->visit('/search-property')
// 			->type($name, 'name')
// 			->press('Search')
// 			->see($name)
// 			->click('View')
		
// 			->press('Update Property')
// 			->see('Update Property')
// 			->see($name)
			 
// 			->type($name . ' Updated', 'name')
// 			->press('Update Property')
// 			->see('Property updated')
// 			->see($name . ' Updated');
// 	}
	
// 	/**
// 	 * Test searching for a property
// 	 */
// 	public function testAddPropertyThenSearchPropertyThenUpdateProperty()
// 	{
// 		$name = 'Test Property';
	
// 		$this->visit('/')
// 			->visit('/login')
// 			->type('jaco.wk@gmail.com', 'email')
// 			->type('password', 'password')
// 			->press('Login')
// 			->visit('/search-property')
		
// 			->press('Add Property')
// 			->type($name, 'name')
// 			->press('Add Property')
		
// 			->visit('/search-property')
// 			->type($name, 'name')
// 			->press('Search')
// 			->see($name)
		
// 			->click('Update')
// 			->see('Update Property')
// 			->see($name)
			
// 			->type($name . ' Updated', 'name')
// 			->press('Update Property')
// 			->see('Property updated')
// 			->see($name . ' Updated');
// 	}
}
