<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Unit test for testing Lead Type functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-12-12
 *
 */
class LookupLeadTypeTest extends TestCase
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
	 * Test logging in, and navigating to the Search Lead Type page
	 *
	 * @return void
	 */
	public function testSearchLookupLeadType()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-lead-type')
			->see('Search Lead Types');
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddLookupLeadType()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-lead-type')
		
			->press('Add Lead Type')
			->seePageIs('/add-lead-type')
			->type('Test Lead Type 1000', 'description')
			->press('Add Lead Type')
		
			->see('Lead Type saved');
	}
	
	/**
	 * Test searching for a title
	 */
	public function testDoAddLookupLeadTypeThenSearchLookupLeadType()
	{
		$description = 'Test Lead Type 1000';
			
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-lead-type')
		
			->press('Add Lead Type')
			->type($description, 'description')
			->press('Add Lead Type')
		
			->visit('/search-lead-type')
			->type($description, 'description')
			->press('Search')
			->see($description);
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddLookupLeadTypeThenViewLookupLeadType()
	{
		$description = 'Test Lead Type 1000';
			
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-lead-type')
		
			->press('Add Lead Type')
			->type($description, 'description')
			->press('Add Lead Type')
		
			->visit('/search-lead-type')
			->type($description, 'description')
			->press('Search')
			->see($description)
			->click('View')
			->see('View Lead Type')
			->see($description);
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddLookupLeadTypeThenViewLookupLeadTypeThenUpdateLookupLeadType()
	{
		$description = 'Test Lead Type 1000';
			
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-lead-type')
		
			->press('Add Lead Type')
			->type($description, 'description')
			->press('Add Lead Type')
		
			->visit('/search-lead-type')
			->type($description, 'description')
			->press('Search')
			->see($description)
			->click('View')
		
			->press('Update Lead Type')
			->see('Update Lead Type')
			->see($description)
		
			->type($description . ' Updated', 'description')
			->press('Update Lead Type')
			->see('Lead Type updated')
			->see($description . ' Updated');
	}
	
	/**
	 * Test searching for a title
	 */
	public function testAddLookupLeadTypeThenSearchLookupLeadTypeThenUpdateLookupLeadType()
	{
		$description = 'Test Lead Type 1000';
	
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-lead-type')
		
			->press('Add Lead Type')
			->type($description, 'description')
			->press('Add Lead Type')
		
			->visit('/search-lead-type')
			->type($description, 'description')
			->press('Search')
			->see($description)
		
			->click('Update')
			->see('Update Lead Type')
			->see($description)
				
			->type($description . ' Updated', 'description')
			->press('Update Lead Type')
			->see('Lead Type updated')
			->see($description . ' Updated');
	}
}
