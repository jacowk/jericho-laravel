<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Unit test for testing Permission functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-17
 *
 */
class PermissionTest extends AbstractUnitTest
{
	/**
	 * Test logging in, and navigating to the Search Permission page
	 *
	 * @return void
	 */
	public function testSearchPermission()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-permission')
			->see('Search Permissions');
	}

	/**
	 * Test adding a permission
	 */
	public function testAddPermission()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-permission')
	
			->press('Add Permission')
			->seePageIs('/add-permission')
			->type('Test Permission', 'name')
			->press('Add Permission')
	
			->see('Permission saved');
	}

	/**
	 * Test searching for a permission
	 */
	public function testDoAddPermissionThenSearchPermission()
	{
		$name = 'Test Permission';
			
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-permission')
	
			->press('Add Permission')
			->type($name, 'name')
			->press('Add Permission')
	
			->visit('/search-permission')
			->type($name, 'name')
			->press('Search')
			->see($name);
	}

	/**
	 * Test adding a permission
	 */
	public function testAddPermissionThenViewPermission()
	{
		$name = 'Test Permission';
			
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-permission')
	
			->press('Add Permission')
			->type($name, 'name')
			->press('Add Permission')
	
			->visit('/search-permission')
			->type($name, 'name')
			->press('Search')
			->see($name)
			->click('View')
			->see('View Permission')
			->see($name);
	}

	/**
	 * Test adding a permission
	 */
	public function testAddPermissionThenViewPermissionThenUpdatePermission()
	{
		$name = 'Test Permission';
			
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-permission')
	
			->press('Add Permission')
			->type($name, 'name')
			->press('Add Permission')
	
			->visit('/search-permission')
			->type($name, 'name')
			->press('Search')
			->see($name)
			->click('View')
	
			->press('Update Permission')
			->see('Update Permission')
			->see($name)
	
			->type($name . ' Updated', 'name')
			->press('Update Permission')
			->see('Permission updated')
			->see($name . ' Updated');
	}

	/**
	 * Test searching for a permission
	 */
	public function testAddPermissionThenSearchPermissionThenUpdatePermission()
	{
		$name = 'Test Permission';

		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-permission')
	
			->press('Add Permission')
			->type($name, 'name')
			->press('Add Permission')
	
			->visit('/search-permission')
			->type($name, 'name')
			->press('Search')
			->see($name)
	
			->click('Update')
			->see('Update Permission')
			->see($name)
				
			->type($name . ' Updated', 'name')
			->press('Update Permission')
			->see('Permission updated')
			->see($name . ' Updated');
	}
}
