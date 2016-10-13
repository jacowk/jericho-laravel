<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Test the login page
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-13
 *
 */
class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $this->visit('/')
    		->visit('/login')
    		->type('jaco.wk@gmail.com', 'email')
    		->type('password', 'password')
    		->press('Login')
    		->seePageIs('/home');
    }
}
