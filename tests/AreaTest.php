<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Area;

/**
 * Unit test for testing Area functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-18
 *
 */
class AreaTest extends TestCase
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
	 * Test logging in, and navigating to the Search Area page
	 *
	 * @return void
	 */
	public function testSearchArea()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-area')
			->see('Search Areas');
	}
	
	/**
	 * Test adding a area
	 */
	public function testAddArea()
	{
		$name = 'Test Area 1000';
		
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-area')
		
			->press('Add Area')
			->seePageIs('/add-area')
			->type($name, 'name')
			->press('Add Area')
		
			->see('Area saved');
		
		$this->deleteArea($name);
	}
	
	/**
	 * Test searching for a area
	 */
	public function testDoAddAreaThenSearchArea()
	{
		$name = 'Test Area 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-area')
		
			->press('Add Area')
			->type($name, 'name')
			->press('Add Area')
		
			->visit('/search-area')
			->type($name, 'name')
			->press('Search')
			->see($name);
		
		$this->deleteArea($name);
	}
	
	/**
	 * Test adding a area
	 */
	public function testAddAreaThenViewArea()
	{
		$name = 'Test Area 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-area')
		
			->press('Add Area')
			->type($name, 'name')
			->press('Add Area')
		
			->visit('/search-area')
			->type($name, 'name')
			->press('Search')
			->see($name)
			->click('View')
			->see('View Area')
			->see($name);
		
		$this->deleteArea($name);
	}
	
	/**
	 * Test adding a area
	 */
	public function testAddAreaThenViewAreaThenUpdateArea()
	{
		$name = 'Test Area 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-area')
		
			->press('Add Area')
			->type($name, 'name')
			->press('Add Area')
		
			->visit('/search-area')
			->type($name, 'name')
			->press('Search')
			->see($name)
			->click('View')
		
			->press('Update Area')
			->see('Update Area')
			->see($name)
			 
			->type($name . ' Updated', 'name')
			->press('Update Area')
			->see('Area updated')
			->see($name . ' Updated');
		
		$this->deleteArea($name . ' Updated');
	}
	
	/**
	 * Test searching for a area
	 */
	public function testAddAreaThenSearchAreaThenUpdateArea()
	{
		$name = 'Test Area 1000';
	
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-area')
		
			->press('Add Area')
			->type($name, 'name')
			->press('Add Area')
		
			->visit('/search-area')
			->type($name, 'name')
			->press('Search')
			->see($name)
		
			->click('Update')
			->see('Update Area')
			->see($name)
			
			->type($name . ' Updated', 'name')
			->press('Update Area')
			->see('Area updated')
			->see($name . ' Updated');
		
		$this->deleteArea($name . ' Updated');
	}
	
	private function deleteArea($name)
	{
		$area = Area::where('name', 'like', $name)->first();
		$area->delete();
	}
}
