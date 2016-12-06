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
class PropertyTest extends TestCase
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
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		$this->assertTrue(true);
	}
	
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
			->see('Search Properties');
	}
	
	/**
	 * Test adding a property
	 */
	public function testAddProperty()
	{
		$address_line_1 = "Test address line 1000";
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
			->select($area_id, 'area_id')
			->select($greater_area_id, 'greater_area_id')
			->select($lookup_property_type_id, 'lookup_property_type_id')
			
			->press('Add Property')
		
			->see('Property saved')
			->see($address_line_1)
			->see($portion_number)
			->see($erf_number)
			->see($size)
			->see($lookup_property_type_id);
	}
	
	/**
	 * Test searching for a property
	 */
	public function testDoAddPropertyThenSearchProperty()
	{
		$address_line_1 = "Test address line 1000";
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
			->type($address_line_1, 'address_line_1')
			->type($portion_number, 'portion_number')
			->type($erf_number, 'erf_number')
			->type($size, 'size')
			->select($area_id, 'area_id')
			->select($greater_area_id, 'greater_area_id')
			->select($lookup_property_type_id, 'lookup_property_type_id')
			->press('Add Property')
		
			->visit('/search-property')
			->type($address_line_1, 'address')
			->press('Search')
			->see($address_line_1)
			->see($portion_number)
			->see($erf_number)
			->see($size);
	}
	
	/**
	 * Test adding a property
	 */
	public function testAddPropertyThenViewProperty()
	{
		$address_line_1 = "Test address line 1000";
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
			->type($address_line_1, 'address_line_1')
			->type($portion_number, 'portion_number')
			->type($erf_number, 'erf_number')
			->type($size, 'size')
			->select($area_id, 'area_id')
			->select($greater_area_id, 'greater_area_id')
			->select($lookup_property_type_id, 'lookup_property_type_id')
			->press('Add Property')
		
			->visit('/search-property')
			->type($address_line_1, 'address')
			->press('Search')
			->see($address_line_1)
			
			->click('View')
			->see('View Property')
			->see($address_line_1)
			->see($portion_number)
			->see($erf_number)
			->see($size);
	}
	
	/**
	 * Test adding a property
	 */
	public function testAddPropertyThenViewPropertyThenUpdateProperty()
	{
		$address_line_1 = "Test address line 1000";
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
			->type($address_line_1, 'address_line_1')
			->type($portion_number, 'portion_number')
			->type($erf_number, 'erf_number')
			->type($size, 'size')
			->select($area_id, 'area_id')
			->select($greater_area_id, 'greater_area_id')
			->select($lookup_property_type_id, 'lookup_property_type_id')
			->press('Add Property')
		
			->visit('/search-property')
			->type($address_line_1, 'address')
			->press('Search')
			->see($address_line_1)
			->click('View')
		
			->press('Update Property')
			->see('Update Property')
			->see($address_line_1)
			 
			->type($address_line_1 . ' Updated', 'address_line_1')
			->type($portion_number, 'portion_number')
			->type($erf_number, 'erf_number')
			->type($size, 'size')
			->press('Update Property')
			->see('Property updated')
			->see($address_line_1 . ' Updated');
	}
	
	/**
	 * Test searching for a property
	 */
	public function testAddPropertyThenSearchPropertyThenUpdateProperty()
	{
		$address_line_1 = "Test address line 1000";
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
			->type($address_line_1, 'address_line_1')
			->type($portion_number, 'portion_number')
			->type($erf_number, 'erf_number')
			->type($size, 'size')
			->select($area_id, 'area_id')
			->select($greater_area_id, 'greater_area_id')
			->select($lookup_property_type_id, 'lookup_property_type_id')
			->press('Add Property')
		
			->visit('/search-property')
			->type($address_line_1, 'address')
			->press('Search')
			->see($address_line_1)
		
			->click('Update')
			->see('Update Property')
			->see($address_line_1)
			
			->type($address_line_1 . ' Updated', 'address_line_1')
			->type($portion_number, 'portion_number')
			->type($erf_number, 'erf_number')
			->type($size, 'size')
			->press('Update Property')
			->see('Property updated')
			->see($address_line_1 . ' Updated');
	}
}
