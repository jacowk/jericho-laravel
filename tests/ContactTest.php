<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Unit test for testing Contact functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-18
 *
 */
class ContactTest extends AbstractUnitTest
{
	/**
	 * Test logging in, and navigating to the Search Contact page
	 *
	 * @return void
	 */
	public function testSearchContact()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-contact')
			->see('Search Contacts');
	}
	
	/**
	 * Test adding a contact
	 */
	public function testAddContact()
	{
		$firstname = 'Ramond';
		$surname = 'Dow';
		$work_email = 'ramond@test.com';
		$personal_email = 'ramond@test.com';
		
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-contact')
		
			->press('Add Contact')
			->seePageIs('/add-contact')
			->type($firstname, 'firstname')
			->type($surname, 'surname')
			->type($work_email, 'work_email')
			->type($personal_email, 'personal_email')
			->press('Add Contact')
		
			->see('Contact saved');
	}
	
	/**
	 * Test searching for a contact
	 */
	public function testDoAddContactThenSearchContact()
	{
		$firstname = 'Ramond';
		$surname = 'Dow';
		$work_email = 'ramond@test.com';
		$personal_email = 'ramond@test.com';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-contact')
		
			->press('Add Contact')
			->type($firstname, 'firstname')
			->type($surname, 'surname')
			->type($work_email, 'work_email')
			->type($personal_email, 'personal_email')
			->press('Add Contact')
		
			->visit('/search-contact')
			->type($firstname, 'firstname')
			->type($surname, 'surname')
			->press('Search')
			->see($firstname)
			->see($surname);
	}
	
	/**
	 * Test adding a contact
	 */
	public function testAddContactThenViewContact()
	{
		$firstname = 'Ramond';
		$surname = 'Dow';
		$work_email = 'ramond@test.com';
		$personal_email = 'ramond@test.com';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-contact')
		
			->press('Add Contact')
			->type($firstname, 'firstname')
			->type($surname, 'surname')
			->type($work_email, 'work_email')
			->type($personal_email, 'personal_email')
			->press('Add Contact')
		
			->visit('/search-contact')
			->type($firstname, 'firstname')
			->type($surname, 'surname')
			->press('Search')
			->see($firstname)
			->see($surname)
			->click('View')
			->see('View Contact')
			->see($firstname)
			->see($surname);
	}
	
	/**
	 * Test adding a contact
	 */
	public function testAddContactThenViewContactThenUpdateContact()
	{
		$firstname = 'Ramond';
		$surname = 'Dow';
		$work_email = 'ramond@test.com';
		$personal_email = 'ramond@test.com';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-contact')
		
			->press('Add Contact')
			->type($firstname, 'firstname')
			->type($surname, 'surname')
			->type($work_email, 'work_email')
			->type($personal_email, 'personal_email')
			->press('Add Contact')
		
			->visit('/search-contact')
			->type($firstname, 'firstname')
			->type($surname, 'surname')
			->press('Search')
			->see($firstname)
			->see($surname)
			->click('View')
		
			->press('Update Contact')
			->see('Update Contact')
			->see($firstname)
			->see($surname)
			 
			->type($firstname . ' Updated', 'firstname')
			->press('Update Contact')
			->see('Contact updated')
			->see($firstname . ' Updated');
	}
	
	/**
	 * Test searching for a contact
	 */
	public function testAddContactThenSearchContactThenUpdateContact()
	{
		$firstname = 'Ramond';
		$surname = 'Dow';
		$work_email = 'ramond@test.com';
		$personal_email = 'ramond@test.com';
	
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-contact')
		
			->press('Add Contact')
			->type($firstname, 'firstname')
			->type($surname, 'surname')
			->type($work_email, 'work_email')
			->type($personal_email, 'personal_email')
			->press('Add Contact')
		
			->visit('/search-contact')
			->type($firstname, 'firstname')
			->type($surname, 'surname')
			->press('Search')
			->see($firstname)
			->see($surname)
		
			->click('Update')
			->see('Update Contact')
			->see($firstname)
			->see($surname)
			
			->type($firstname . ' Updated', 'firstname')
			->press('Update Contact')
			->see('Contact updated')
			->see($firstname . ' Updated');
	}
}
