<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Unit test for testing Estate Agent Type functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-18
 *
 */
class LookupEstateAgentTypeTest extends TestCase
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
	 * Test logging in, and navigating to the Search Estate Agent Type page
	 *
	 * @return void
	 */
	public function testSearchLookupEstateAgentType()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-estate-agent-type')
			->see('Search Estate Agent Types');
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddLookupEstateAgentType()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-estate-agent-type')
		
			->press('Add Estate Agent Type')
			->seePageIs('/add-estate-agent-type')
			->type('Test Estate Agent Type 1000', 'description')
			->press('Add Estate Agent Type')
		
			->see('Estate Agent Type saved');
	}
	
	/**
	 * Test searching for a title
	 */
	public function testDoAddLookupEstateAgentTypeThenSearchLookupEstateAgentType()
	{
		$description = 'Test Estate Agent Type 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-estate-agent-type')
		
			->press('Add Estate Agent Type')
			->type($description, 'description')
			->press('Add Estate Agent Type')
		
			->visit('/search-estate-agent-type')
			->type($description, 'description')
			->press('Search')
			->see($description);
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddLookupEstateAgentTypeThenViewLookupEstateAgentType()
	{
		$description = 'Test Estate Agent Type 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-estate-agent-type')
		
			->press('Add Estate Agent Type')
			->type($description, 'description')
			->press('Add Estate Agent Type')
		
			->visit('/search-estate-agent-type')
			->type($description, 'description')
			->press('Search')
			->see($description)
			->click('View')
			->see('View Estate Agent Type')
			->see($description);
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddLookupEstateAgentTypeThenViewLookupEstateAgentTypeThenUpdateLookupEstateAgentType()
	{
		$description = 'Test Estate Agent Type 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-estate-agent-type')
		
			->press('Add Estate Agent Type')
			->type($description, 'description')
			->press('Add Estate Agent Type')
		
			->visit('/search-estate-agent-type')
			->type($description, 'description')
			->press('Search')
			->see($description)
			->click('View')
		
			->press('Update Estate Agent Type')
			->see('Update Estate Agent Type')
			->see($description)
			 
			->type($description . ' Updated', 'description')
			->press('Update Estate Agent Type')
			->see('Estate Agent Type updated')
			->see($description . ' Updated');
	}
	
	/**
	 * Test searching for a title
	 */
	public function testAddLookupEstateAgentTypeThenSearchLookupEstateAgentTypeThenUpdateLookupEstateAgentType()
	{
		$description = 'Test Estate Agent Type 1000';
	
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-estate-agent-type')
		
			->press('Add Estate Agent Type')
			->type($description, 'description')
			->press('Add Estate Agent Type')
		
			->visit('/search-estate-agent-type')
			->type($description, 'description')
			->press('Search')
			->see($description)
		
			->click('Update')
			->see('Update Estate Agent Type')
			->see($description)
			
			->type($description . ' Updated', 'description')
			->press('Update Estate Agent Type')
			->see('Estate Agent Type updated')
			->see($description . ' Updated');
	}
}
