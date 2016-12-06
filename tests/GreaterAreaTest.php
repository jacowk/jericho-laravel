<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Unit test for testing Greater Area functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-18
 *
 */
class GreaterAreaTest extends TestCase
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
	 * Test logging in, and navigating to the Search Greater Area page
	 *
	 * @return void
	 */
	public function testSearchGreaterArea()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-greater-area')
			->see('Search Greater Areas');
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddGreaterArea()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-greater-area')
		
			->press('Add Greater Area')
			->seePageIs('/add-greater-area')
			->type('Test Greater Area 1000', 'name')
			->press('Add Greater Area')
		
			->see('Greater Area saved');
	}
	
	/**
	 * Test searching for a title
	 */
	public function testDoAddGreaterAreaThenSearchGreaterArea()
	{
		$name = 'Test Greater Area 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-greater-area')
		
			->press('Add Greater Area')
			->type($name, 'name')
			->press('Add Greater Area')
		
			->visit('/search-greater-area')
			->type($name, 'name')
			->press('Search')
			->see($name);
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddGreaterAreaThenViewGreaterArea()
	{
		$name = 'Test Greater Area 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-greater-area')
		
			->press('Add Greater Area')
			->type($name, 'name')
			->press('Add Greater Area')
		
			->visit('/search-greater-area')
			->type($name, 'name')
			->press('Search')
			->see($name)
			->click('View')
			->see('View Greater Area')
			->see($name);
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddGreaterAreaThenViewGreaterAreaThenUpdateGreaterArea()
	{
		$name = 'Test Greater Area 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-greater-area')
		
			->press('Add Greater Area')
			->type($name, 'name')
			->press('Add Greater Area')
		
			->visit('/search-greater-area')
			->type($name, 'name')
			->press('Search')
			->see($name)
			->click('View')
		
			->press('Update Greater Area')
			->see('Update Greater Area')
			->see($name)
			 
			->type($name . ' Updated', 'name')
			->press('Update Greater Area')
			->see('Greater Area updated')
			->see($name . ' Updated');
	}
	
	/**
	 * Test searching for a title
	 */
	public function testAddGreaterAreaThenSearchGreaterAreaThenUpdateGreaterArea()
	{
		$name = 'Test Greater Area 1000';
	
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-greater-area')
		
			->press('Add Greater Area')
			->type($name, 'name')
			->press('Add Greater Area')
		
			->visit('/search-greater-area')
			->type($name, 'name')
			->press('Search')
			->see($name)
		
			->click('Update')
			->see('Update Greater Area')
			->see($name)
			
			->type($name . ' Updated', 'name')
			->press('Update Greater Area')
			->see('Greater Area updated')
			->see($name . ' Updated');
	}
}
