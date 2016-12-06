<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Unit test for testing Document Type functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-18
 *
 */
class LookupDocumentTypeTest extends TestCase
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
	 * Test logging in, and navigating to the Search Document Type page
	 *
	 * @return void
	 */
	public function testSearchLookupDocumentType()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-document-type')
			->see('Search Document Types');
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddLookupDocumentType()
	{
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-document-type')
		
			->press('Add Document Type')
			->seePageIs('/add-document-type')
			->type('Test Document Type 1000', 'description')
			->press('Add Document Type')
		
			->see('Document Type saved');
	}
	
	/**
	 * Test searching for a title
	 */
	public function testDoAddLookupDocumentTypeThenSearchLookupDocumentType()
	{
		$description = 'Test Document Type 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-document-type')
		
			->press('Add Document Type')
			->type($description, 'description')
			->press('Add Document Type')
		
			->visit('/search-document-type')
			->type($description, 'description')
			->press('Search')
			->see($description);
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddLookupDocumentTypeThenViewLookupDocumentType()
	{
		$description = 'Test Document Type 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-document-type')
		
			->press('Add Document Type')
			->type($description, 'description')
			->press('Add Document Type')
		
			->visit('/search-document-type')
			->type($description, 'description')
			->press('Search')
			->see($description)
			->click('View')
			->see('View Document Type')
			->see($description);
	}
	
	/**
	 * Test adding a title
	 */
	public function testAddLookupDocumentTypeThenViewLookupDocumentTypeThenUpdateLookupDocumentType()
	{
		$description = 'Test Document Type 1000';
		 
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-document-type')
		
			->press('Add Document Type')
			->type($description, 'description')
			->press('Add Document Type')
		
			->visit('/search-document-type')
			->type($description, 'description')
			->press('Search')
			->see($description)
			->click('View')
		
			->press('Update Document Type')
			->see('Update Document Type')
			->see($description)
			 
			->type($description . ' Updated', 'description')
			->press('Update Document Type')
			->see('Document Type updated')
			->see($description . ' Updated');
	}
	
	/**
	 * Test searching for a title
	 */
	public function testAddLookupDocumentTypeThenSearchLookupDocumentTypeThenUpdateLookupDocumentType()
	{
		$description = 'Test Document Type 1000';
	
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-document-type')
		
			->press('Add Document Type')
			->type($description, 'description')
			->press('Add Document Type')
		
			->visit('/search-document-type')
			->type($description, 'description')
			->press('Search')
			->see($description)
		
			->click('Update')
			->see('Update Document Type')
			->see($description)
			
			->type($description . ' Updated', 'description')
			->press('Update Document Type')
			->see('Document Type updated')
			->see($description . ' Updated');
	}
}
