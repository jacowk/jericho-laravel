<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Unit test for testing Attorney functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-17
 *
 */
class AttorneyTest extends TestCase
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
	 * Test logging in, and navigating to the Search Attorney page
	 *
	 * @return void
	 */
	public function testSearchAttorney()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-attorney')
			->see('Search Attorneys');
	}
	
	/**
	 * Test adding a attorney
	 */
	public function testAddAttorney()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-attorney')
		
			->press('Add Attorney')
			->seePageIs('/add-attorney')
			->type('Test Attorney', 'name')
			->press('Add Attorney')
		
			->see('Attorney saved');
	}
	
	/**
	 * Test searching for a attorney
	 */
	public function testDoAddAttorneyThenSearchAttorney()
	{
		$name = 'Test Attorney';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-attorney')
		
			->press('Add Attorney')
			->type($name, 'name')
			->press('Add Attorney')
		
			->visit('/search-attorney')
			->type($name, 'name')
			->press('Search')
			->see($name);
	}
	
	/**
	 * Test adding a attorney
	 */
	public function testAddAttorneyThenViewAttorney()
	{
		$name = 'Test Attorney';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-attorney')
		
			->press('Add Attorney')
			->type($name, 'name')
			->press('Add Attorney')
		
			->visit('/search-attorney')
			->type($name, 'name')
			->press('Search')
			->see($name)
			->click('View')
			->see('View Attorney')
			->see($name);
	}
	
	/**
	 * Test adding a attorney
	 */
	public function testAddAttorneyThenViewAttorneyThenUpdateAttorney()
	{
		$name = 'Test Attorney';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-attorney')
		
			->press('Add Attorney')
			->type($name, 'name')
			->press('Add Attorney')
		
			->visit('/search-attorney')
			->type($name, 'name')
			->press('Search')
			->see($name)
			->click('View')
		
			->press('Update Attorney')
			->see('Update Attorney')
			->see($name)
			 
			->type($name . ' Updated', 'name')
			->press('Update Attorney')
			->see('Attorney updated')
			->see($name . ' Updated');
	}
	
	/**
	 * Test searching for a attorney
	 */
	public function testAddAttorneyThenSearchAttorneyThenUpdateAttorney()
	{
		$name = 'Test Attorney';
	
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-attorney')
		
			->press('Add Attorney')
			->type($name, 'name')
			->press('Add Attorney')
		
			->visit('/search-attorney')
			->type($name, 'name')
			->press('Search')
			->see($name)
		
			->click('Update')
			->see('Update Attorney')
			->see($name)
			
			->type($name . ' Updated', 'name')
			->press('Update Attorney')
			->see('Attorney updated')
			->see($name . ' Updated');
	}
}
