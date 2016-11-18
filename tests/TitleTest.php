<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Unit test for testing Title functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-18
 *
 */
class TitleTest extends AbstractUnitTest
{
    /**
	 * Test logging in, and navigating to the Search Title page
	 *
	 * @return void
	 */
	public function testSearchTitle()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-title')
			->see('Search Titles');
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddTitle()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-title')
		
			->press('Add Title')
			->seePageIs('/add-title')
			->type('Test Title 1000', 'description')
			->press('Add Title')
		
			->see('Title saved');
	}
	
	/**
	 * Test searching for a title
	 */
	public function testDoAddTitleThenSearchTitle()
	{
		$description = 'Test Title 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-title')
		
			->press('Add Title')
			->type($description, 'description')
			->press('Add Title')
		
			->visit('/search-title')
			->type($description, 'description')
			->press('Search')
			->see($description);
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddTitleThenViewTitle()
	{
		$description = 'Test Title 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-title')
		
			->press('Add Title')
			->type($description, 'description')
			->press('Add Title')
		
			->visit('/search-title')
			->type($description, 'description')
			->press('Search')
			->see($description)
			->click('View')
			->see('View Title')
			->see($description);
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddTitleThenViewTitleThenUpdateTitle()
	{
		$description = 'Test Title 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-title')
		
			->press('Add Title')
			->type($description, 'description')
			->press('Add Title')
		
			->visit('/search-title')
			->type($description, 'description')
			->press('Search')
			->see($description)
			->click('View')
		
			->press('Update Title')
			->see('Update Title')
			->see($description)
			 
			->type($description . ' Updated', 'description')
			->press('Update Title')
			->see('Title updated')
			->see($description . ' Updated');
	}
	
	/**
	 * Test searching for a title
	 */
	public function testAddTitleThenSearchTitleThenUpdateTitle()
	{
		$description = 'Test Title 1000';
	
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-title')
		
			->press('Add Title')
			->type($description, 'description')
			->press('Add Title')
		
			->visit('/search-title')
			->type($description, 'description')
			->press('Search')
			->see($description)
		
			->click('Update')
			->see('Update Title')
			->see($description)
			
			->type($description . ' Updated', 'description')
			->press('Update Title')
			->see('Title updated')
			->see($description . ' Updated');
	}
}
