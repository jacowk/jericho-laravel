<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Unit test for testing Milestone Type functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-18
 *
 */
class LookupMilestoneTypeTest extends TestCase
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
	 * Test logging in, and navigating to the Search Milestone Type page
	 *
	 * @return void
	 */
	public function testSearchLookupMilestoneType()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-milestone-type')
			->see('Search Milestone Types');
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddLookupMilestoneType()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-milestone-type')
		
			->press('Add Milestone Type')
			->seePageIs('/add-milestone-type')
			->type('Test Milestone Type 1000', 'description')
			->press('Add Milestone Type')
		
			->see('Milestone Type saved');
	}
	
	/**
	 * Test searching for a title
	 */
	public function testDoAddLookupMilestoneTypeThenSearchLookupMilestoneType()
	{
		$description = 'Test Milestone Type 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-milestone-type')
		
			->press('Add Milestone Type')
			->type($description, 'description')
			->press('Add Milestone Type')
		
			->visit('/search-milestone-type')
			->type($description, 'description')
			->press('Search')
			->see($description);
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddLookupMilestoneTypeThenViewLookupMilestoneType()
	{
		$description = 'Test Milestone Type 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-milestone-type')
		
			->press('Add Milestone Type')
			->type($description, 'description')
			->press('Add Milestone Type')
		
			->visit('/search-milestone-type')
			->type($description, 'description')
			->press('Search')
			->see($description)
			->click('View')
			->see('View Milestone Type')
			->see($description);
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddLookupMilestoneTypeThenViewLookupMilestoneTypeThenUpdateLookupMilestoneType()
	{
		$description = 'Test Milestone Type 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-milestone-type')
		
			->press('Add Milestone Type')
			->type($description, 'description')
			->press('Add Milestone Type')
		
			->visit('/search-milestone-type')
			->type($description, 'description')
			->press('Search')
			->see($description)
			->click('View')
		
			->press('Update Milestone Type')
			->see('Update Milestone Type')
			->see($description)
			 
			->type($description . ' Updated', 'description')
			->press('Update Milestone Type')
			->see('Milestone Type updated')
			->see($description . ' Updated');
	}
	
	/**
	 * Test searching for a title
	 */
	public function testAddLookupMilestoneTypeThenSearchLookupMilestoneTypeThenUpdateLookupMilestoneType()
	{
		$description = 'Test Milestone Type 1000';
	
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-milestone-type')
		
			->press('Add Milestone Type')
			->type($description, 'description')
			->press('Add Milestone Type')
		
			->visit('/search-milestone-type')
			->type($description, 'description')
			->press('Search')
			->see($description)
		
			->click('Update')
			->see('Update Milestone Type')
			->see($description)
			
			->type($description . ' Updated', 'description')
			->press('Update Milestone Type')
			->see('Milestone Type updated')
			->see($description . ' Updated');
	}
}
