<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Suburb;

/**
 * Unit test for testing Suburb functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-18
 *
 */
class SuburbTest extends AbstractUnitTest
{
	/**
	 * A basic test example.
	 *
	 * @return void
	 */
	public function testExample()
	{
		$this->assertTrue(true);
	}
    
    /**
	 * Test logging in, and navigating to the Search Suburb page
	 *
	 * @return void
	 */
	public function testSearchSuburb()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-suburb')
			->see('Search Suburbs');
	}
	
	/**
	 * Test adding a suburb
	 */
	public function testAddSuburb()
	{
		$name = 'Test Suburb 10000';
		
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-suburb')
		
			->press('Add Suburb')
			->seePageIs('/add-suburb')
			->type($name, 'name')
			->select('1', 'area_id')
			->press('Add Suburb')
			
			->see('Suburb saved');
		
		$this->deleteSuburb($name);
	}
	
	/**
	 * Test searching for a suburb
	 */
	public function testDoAddSuburbThenSearchSuburb()
	{
		$name = 'Test Suburb 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-suburb')
		
			->press('Add Suburb')
			->type($name, 'name')
			->select('1', 'area_id')
			->press('Add Suburb')
		
			->visit('/search-suburb')
			->type($name, 'name')
			->press('Search')
			->see($name);
		
		$this->deleteSuburb($name);
	}
	
	/**
	 * Test adding a suburb
	 */
	public function testAddSuburbThenViewSuburb()
	{
		$name = 'Test Suburb 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-suburb')
		
			->press('Add Suburb')
			->type($name, 'name')
			->select('1', 'area_id')
			->press('Add Suburb')
		
			->visit('/search-suburb')
			->type($name, 'name')
			->press('Search')
			->see($name)
			->click('View')
			->see('View Suburb')
			->see($name);
		
		$this->deleteSuburb($name);
	}
	
	/**
	 * Test adding a suburb
	 */
	public function testAddSuburbThenViewSuburbThenUpdateSuburb()
	{
		$name = 'Test Suburb 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-suburb')
		
			->press('Add Suburb')
			->type($name, 'name')
			->select('1', 'area_id')
			->press('Add Suburb')
		
			->visit('/search-suburb')
			->type($name, 'name')
			->press('Search')
			->see($name)
			->click('View')
		
			->press('Update Suburb')
			->see('Update Suburb')
			->see($name)
			 
			->type($name . ' Updated', 'name')
			->press('Update Suburb')
			->see('Suburb updated')
			->see($name . ' Updated');
		
		$this->deleteSuburb($name . ' Updated');
	}
	
	/**
	 * Test searching for a suburb
	 */
	public function testAddSuburbThenSearchSuburbThenUpdateSuburb()
	{
		$name = 'Test Suburb 1000';
	
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-suburb')
		
			->press('Add Suburb')
			->type($name, 'name')
			->select('1', 'area_id')
			->press('Add Suburb')
		
			->visit('/search-suburb')
			->type($name, 'name')
			->press('Search')
			->see($name)
		
			->click('Update')
			->see('Update Suburb')
			->see($name)
			
			->type($name . ' Updated', 'name')
			->press('Update Suburb')
			->see('Suburb updated')
			->see($name . ' Updated');
		
		$this->deleteSuburb($name . ' Updated');
	}
	
	private function deleteSuburb($name)
	{
		$suburb = Suburb::where('name', 'like', $name)->first();
		$suburb->delete();
	}
}
