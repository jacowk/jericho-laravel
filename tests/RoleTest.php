<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Unit test for testing Role functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-17
 *
 */
class RoleTest extends AbstractUnitTest
{
    /**
	 * Test logging in, and navigating to the Search Role page
	 *
	 * @return void
	 */
	public function testSearchRole()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-role')
			->see('Search Roles');
	}
	
	/**
	 * Test adding a role
	 */
	public function testAddRole()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-role')
		
			->press('Add Role')
			->seePageIs('/add-role')
			->type('Test Role', 'name')
			->press('Add Role')
		
			->see('Role saved');
	}
	
	/**
	 * Test searching for a role
	 */
	public function testDoAddRoleThenSearchRole()
	{
		$name = 'Test Role';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-role')
		
			->press('Add Role')
			->type($name, 'name')
			->press('Add Role')
		
			->visit('/search-role')
			->type($name, 'name')
			->press('Search')
			->see($name);
	}
	
	/**
	 * Test adding a role
	 */
	public function testAddRoleThenViewRole()
	{
		$name = 'Test Role';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-role')
		
			->press('Add Role')
			->type($name, 'name')
			->press('Add Role')
		
			->visit('/search-role')
			->type($name, 'name')
			->press('Search')
			->see($name)
			->click('View')
			->see('View Role')
			->see($name);
	}
	
	/**
	 * Test adding a role
	 */
	public function testAddRoleThenViewRoleThenUpdateRole()
	{
		$name = 'Test Role';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-role')
		
			->press('Add Role')
			->type($name, 'name')
			->press('Add Role')
		
			->visit('/search-role')
			->type($name, 'name')
			->press('Search')
			->see($name)
			->click('View')
		
			->press('Update Role')
			->see('Update Role')
			->see($name)
			 
			->type($name . ' Updated', 'name')
			->press('Update Role')
			->see('Role updated')
			->see($name . ' Updated');
	}
	
	/**
	 * Test searching for a role
	 */
	public function testAddRoleThenSearchRoleThenUpdateRole()
	{
		$name = 'Test Role';
	
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-role')
		
			->press('Add Role')
			->type($name, 'name')
			->press('Add Role')
		
			->visit('/search-role')
			->type($name, 'name')
			->press('Search')
			->see($name)
		
			->click('Update')
			->see('Update Role')
			->see($name)
			
			->type($name . ' Updated', 'name')
			->press('Update Role')
			->see('Role updated')
			->see($name . ' Updated');
	}
}
