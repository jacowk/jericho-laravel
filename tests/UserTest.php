<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Unit test for testing User functionality
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-14
 *
 */
class UserTest extends AbstractUnitTest
{
	
	public function testDummyTest()
	{
		$this->assertTrue(true);
	}
	
// 	public function setUp()
// 	{
// 		parent::setUp();
// 		$this->artisan('db:seed');
// 	}
	
// 	public function tearDown()
// 	{
// 		$this->artisan('db:seed');
		
// 		parent::tearDown();
// // 		Mockery::close();
// 	}
	
//     /**
//      * Test logging in, and navigating to the Search User page
//      *
//      * @return void
//      */
//     public function testSearchUser()
//     {
//     	$this->visit('/')
//     		->visit('/login')
//     		->type('jaco.wk@gmail.com', 'email')
//     		->type('password', 'password')
//     		->press('Login')
//     		->visit('/search-user')
//     		->see('Search Users');
//     }
    
//     /**
//      * Test adding a user
//      */
//     public function testAddUser()
//     {
//     	$this->visit('/')
// 	    	->visit('/login')
// 	    	->type('jaco.wk@gmail.com', 'email')
// 	    	->type('password', 'password')
// 	    	->press('Login')
// 	    	->visit('/search-user')
	    	
// 	    	->press('Add User')
// 	    	->seePageIs('/add-user')
// 	    	->type('Jason', 'firstname')
// 	    	->type('Dough', 'surname')
// 	    	->type('jason.dough@test.com', 'email')
// 	    	->type('password', 'password')
// 	    	->type('password_confirmation', 'password')
// 	    	->press('Add User')
	    	
// 	    	->see('User saved');
//     }
    
//     /**
//      * Test searching for a user
//      */
//     public function testDoAddUserThenSearchUser()
//     {
//     	$firstname = 'Jimmy';
//     	$surname = 'Doe';
//     	$email = 'jimmy.doe@test.com';
    	
//     	$this->visit('/')
// 	    	->visit('/login')
// 	    	->type('jaco.wk@gmail.com', 'email')
// 	    	->type('password', 'password')
// 	    	->press('Login')
// 	    	->visit('/search-user')
	    	
// 	    	->press('Add User')
// 	    	->type($firstname, 'firstname')
// 	    	->type($surname, 'surname')
// 	    	->type($email, 'email')
// 	    	->type('password', 'password')
// 	    	->type('password_confirmation', 'password')
// 	    	->press('Add User')
	    	
// 	    	->visit('/search-user')
// 	    	->type($firstname, 'firstname')
// 	    	->type($surname, 'surname')
// 	    	->press('Search')
// 	    	->see($email);
//     }
    
//     /**
//      * Test adding a user
//      */
//     public function testAddUserThenViewUser()
//     {
//     	$firstname = 'Jillian';
//     	$surname = 'Doe';
//     	$email = 'jillian.doe@test.com';
    	
//     	$this->visit('/')
// 	    	->visit('/login')
// 	    	->type('jaco.wk@gmail.com', 'email')
// 	    	->type('password', 'password')
// 	    	->press('Login')
// 	    	->visit('/search-user')
	    	
// 	    	->press('Add User')
// 	    	->type($firstname, 'firstname')
// 	    	->type($surname, 'surname')
// 	    	->type($email, 'email')
// 	    	->type('password', 'password')
// 	    	->type('password_confirmation', 'password')
// 	    	->press('Add User')
	    	
// 	    	->visit('/search-user')
// 	    	->type($firstname, 'firstname')
// 	    	->press('Search')
// 	    	->see($email)
// 	    	->click('View')
// 	    	->see('View User');
//     }
    
//     /**
//      * Test adding a user
//      */
//     public function testAddUserThenViewUserThenUpdateUser()
//     {
//     	$firstname = 'Jack';
//     	$surname = 'Doe';
//     	$email = 'jack.doe@test.com';
    	
//     	$this->visit('/')
// 	    	->visit('/login')
// 	    	->type('jaco.wk@gmail.com', 'email')
// 	    	->type('password', 'password')
// 	    	->press('Login')
// 	    	->visit('/search-user')
	    	
// 	    	->press('Add User')
// 	    	->type($firstname, 'firstname')
// 	    	->type($surname, 'surname')
// 	    	->type($email, 'email')
// 	    	->type('password', 'password')
// 	    	->type('password_confirmation', 'password')
// 	    	->press('Add User')
	    	
// 	    	->visit('/search-user')
// 	    	->type($firstname, 'firstname')
// 	    	->press('Search')
// 	    	->see($email)
// 	    	->click('View')
	    	
// 	    	->press('Update User')
//     		->see('Update User')
//     		->see($email)
    	
//     		->type('Updated', 'surname')
//     		->press('Update User')
//     		->see('User updated');
//     }
    
//     /**
//      * Test searching for a user
//      */
//     public function testAddUserThenSearchUserThenUpdateUser()
//     {
//     	$firstname = 'Jessica';
//     	$surname = 'Doe';
//     	$email = 'jessica.doe@test.com';
    	 
//     	$this->visit('/')
// 	    	->visit('/login')
// 	    	->type('jaco.wk@gmail.com', 'email')
// 	    	->type('password', 'password')
// 	    	->press('Login')
// 	    	->visit('/search-user')
	    	
// 	    	->press('Add User')
// 	    	->type($firstname, 'firstname')
// 	    	->type($surname, 'surname')
// 	    	->type($email, 'email')
// 	    	->type('password', 'password')
// 	    	->type('password_confirmation', 'password')
// 	    	->press('Add User')
	    	
// 	    	->visit('/search-user')
// 	    	->type($firstname, 'firstname')
// 	    	->type($surname, 'surname')
// 	    	->press('Search')
// 	    	->see($email)
	    	
// 	    	->click('Update')
// 	    	->type('Updated', 'surname')
// 	    	->press('Update User')
// 	    	->see('User updated');
//     }
}
