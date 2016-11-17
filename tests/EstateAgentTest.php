<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Unit test for testing Estate Agent functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-17
 *
 */
class EstateAgentTest extends AbstractUnitTest
{
    /**
	 * Test logging in, and navigating to the Search Estate Agent page
	 *
	 * @return void
	 */
	public function testSearchEstateAgent()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-estate-agent')
			->see('Search Estate Agents');
	}
	
	/**
	 * Test adding a role
	 */
	public function testAddEstateAgent()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-estate-agent')
		
			->press('Add Estate Agent')
			->seePageIs('/add-estate-agent')
			->type('Test Estate Agent', 'name')
			->press('Add Estate Agent')
		
			->see('Estate Agent saved');
	}
	
	/**
	 * Test searching for a role
	 */
	public function testDoAddEstateAgentThenSearchEstateAgent()
	{
		$name = 'Test EstateAgent';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-estate-agent')
		
			->press('Add Estate Agent')
			->type($name, 'name')
			->press('Add Estate Agent')
		
			->visit('/search-estate-agent')
			->type($name, 'name')
			->press('Search')
			->see($name);
	}
	
	/**
	 * Test adding a role
	 */
	public function testAddEstateAgentThenViewEstateAgent()
	{
		$name = 'Test Estate Agent';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-estate-agent')
		
			->press('Add Estate Agent')
			->type($name, 'name')
			->press('Add Estate Agent')
		
			->visit('/search-estate-agent')
			->type($name, 'name')
			->press('Search')
			->see($name)
			->click('View')
			->see('View Estate Agent')
			->see($name);
	}
	
	/**
	 * Test adding a role
	 */
	public function testAddEstateAgentThenViewEstateAgentThenUpdateEstateAgent()
	{
		$name = 'Test EstateAgent';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-estate-agent')
		
			->press('Add Estate Agent')
			->type($name, 'name')
			->press('Add Estate Agent')
		
			->visit('/search-estate-agent')
			->type($name, 'name')
			->press('Search')
			->see($name)
			->click('View')
		
			->press('Update EstateAgent')
			->see('Update EstateAgent')
			->see($name)
			 
			->type($name . ' Updated', 'name')
			->press('Update EstateAgent')
			->see('Estate Agent updated')
			->see($name . ' Updated');
	}
	
	/**
	 * Test searching for a role
	 */
	public function testAddEstateAgentThenSearchEstateAgentThenUpdateEstateAgent()
	{
		$name = 'Test EstateAgent';
	
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-estate-agent')
		
			->press('Add EstateAgent')
			->type($name, 'name')
			->press('Add Estate Agent')
		
			->visit('/search-estate-agent')
			->type($name, 'name')
			->press('Search')
			->see($name)
		
			->click('Update')
			->see('Update EstateAgent')
			->see($name)
			
			->type($name . ' Updated', 'name')
			->press('Update EstateAgent')
			->see('Estate Agent updated')
			->see($name . ' Updated');
	}
}
