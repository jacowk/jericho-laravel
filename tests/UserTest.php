<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * Test logging in, and navigating to the Search User page
     *
     * @return void
     */
    public function testSearchUser()
    {
    	$this->visit('/')
    		->visit('/login')
    		->type('jaco.wk@gmail.com', 'email')
    		->type('password', 'password')
    		->press('Login')
    		->visit('/search-user')
    		->see('Search Users');
    }
    
    /**
     * Test searching for a user
     */
    public function testDoSearchUser()
    {
    	$this->visit('/')
	    	->visit('/login')
	    	->type('jaco.wk@gmail.com', 'email')
	    	->type('password', 'password')
	    	->press('Login')
	    	->visit('/search-user')
	    	->type('John', 'firstname')
	    	->type('Doe', 'surname')
	    	->press('Search')
	    	->see('john.doe@test.com');
    }
    
    /**
     * Test adding a user
     */
    public function testAddUser()
    {
    	$this->visit('/')
	    	->visit('/login')
	    	->type('jaco.wk@gmail.com', 'email')
	    	->type('password', 'password')
	    	->press('Login')
	    	->visit('/search-user')
	    	->press('Add User')
	    	->seePageIs('/add-user')
	    	->type('Jason', 'firstname')
	    	->type('Dough', 'surname')
	    	->type('jason.dough@test.com', 'email')
	    	->type('password', 'password')
	    	->press('Add User')
	    	->see('User saved');
    }
}
