<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Property;

/**
 * Unit test for testing Property Flip functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-21
 *
 */
class PropertyFlipTest extends TestCase
{
    /**
	 * Test adding a property flip
	 */
	public function testAddPropertyFlip()
	{
		$property_id = $this->createProperty();
		
		$reference_number = 1100;
		$title_deed_number = 1100;
		$case_number = 'A1234';
		$seller_id = 1;
		$selling_price = 100000.00;
		$purchaser_id = 1;
		$purchase_price = 100000.00;
		$finance_status_id = 1;
		$seller_status_id = 1;
		$created_by_id = 1;
		
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-property')
			
			->type($property_id, 'property_id')
			->press('Search')
			->click('View')
		
			->press('Add Property Flip')
			->seePageIs('/add-property-flip/' . $property_id)
			->type($reference_number, 'reference_number')
			->type($title_deed_number, 'title_deed_number')
			->type($case_number, 'case_number')
			->select($seller_id, 'seller_id')
			->type($selling_price, 'selling_price')
			->select($purchaser_id, 'purchaser_id')
			->type($purchase_price, 'purchase_price')
			->select($finance_status_id, 'finance_status_id')
			->select($seller_status_id, 'seller_status_id')
			->press('Add Property Flip')
		
			->see('Property Flip saved')
			->see($reference_number)
			->see($title_deed_number)
			->see($case_number);
	}
	
	/**
	 * Test searching for a property flip
	 */
	public function testDoAddPropertyFlipThenSearchPropertyFlip()
	{
		$property_id = $this->createProperty();
		
		$reference_number = 1101;
		$title_deed_number = 1101;
		$case_number = 'A1234';
		$seller_id = 1;
		$selling_price = 100000.00;
		$purchaser_id = 1;
		$purchase_price = 100000.00;
		$finance_status_id = 1;
		$seller_status_id = 1;
		$created_by_id = 1;
		
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-property')
				
			->type($property_id, 'property_id')
			->press('Search')
			->click('View')
			
			->press('Add Property Flip')
			->seePageIs('/add-property-flip/' . $property_id)
			->type($reference_number, 'reference_number')
			->type($title_deed_number, 'title_deed_number')
			->type($case_number, 'case_number')
			->select($seller_id, 'seller_id')
			->type($selling_price, 'selling_price')
			->select($purchaser_id, 'purchaser_id')
			->type($purchase_price, 'purchase_price')
			->select($finance_status_id, 'finance_status_id')
			->select($seller_status_id, 'seller_status_id')
			->press('Add Property Flip')
			
			->see('Property Flip saved')
			->see($reference_number)
			->see($title_deed_number)
			->see($case_number)
		
			->visit('/search-property')
			->type($reference_number, 'reference_number')
			->press('Search')
			->see('Test address line 1000');
	}
	
	/**
	 * Test adding a property flip
	 */
	public function testAddPropertyFlipThenViewPropertyFlip()
	{
		$property_id = $this->createProperty();
		
		$reference_number = 1102;
		$title_deed_number = 1102;
		$case_number = 'A1234';
		$seller_id = 1;
		$selling_price = 100000.00;
		$purchaser_id = 1;
		$purchase_price = 100000.00;
		$finance_status_id = 1;
		$seller_status_id = 1;
		$created_by_id = 1;
		
		$this->visit('/')
			->visit('/login')
			->type('jaco.wk@gmail.com', 'email')
			->type('password', 'password')
			->press('Login')
			->visit('/search-property')
			
			->type($property_id, 'property_id')
			->press('Search')
			->click('View')
				
			->press('Add Property Flip')
			->seePageIs('/add-property-flip/' . $property_id)
			->type($reference_number, 'reference_number')
			->type($title_deed_number, 'title_deed_number')
			->type($case_number, 'case_number')
			->select($seller_id, 'seller_id')
			->type($selling_price, 'selling_price')
			->select($purchaser_id, 'purchaser_id')
			->type($purchase_price, 'purchase_price')
			->select($finance_status_id, 'finance_status_id')
			->select($seller_status_id, 'seller_status_id')
			->press('Add Property Flip')
				
			->see('Property Flip saved')
			->see($reference_number)
			->see($title_deed_number)
			->see($case_number)
			
			->visit('/search-property')
			->type($reference_number, 'reference_number')
			->press('Search')
			->see('Test address line 1000')
		
			->click('View')
			->see('View Property')
		
			->click('View')
			->see('View Property Flip');
	}
	
	/**
	 * Test adding a property flip
	 */
	public function testAddPropertyFlipThenViewPropertyFlipThenUpdatePropertyFlip()
	{
		$property_id = $this->createProperty();
		
		$reference_number = 1103;
		$title_deed_number = 1103;
		$case_number = 'A1234';
		$seller_id = 1;
		$selling_price = 100000.00;
		$purchaser_id = 1;
		$purchase_price = 100000.00;
		$finance_status_id = 1;
		$seller_status_id = 1;
		$created_by_id = 1;
		
		$this->visit('/')
				->visit('/login')
				->type('jaco.wk@gmail.com', 'email')
				->type('password', 'password')
				->press('Login')
				->visit('/search-property')
					
				->type($property_id, 'property_id')
				->press('Search')
				->click('View')
				
				->press('Add Property Flip')
				->seePageIs('/add-property-flip/' . $property_id)
				->type($reference_number, 'reference_number')
				->type($title_deed_number, 'title_deed_number')
				->type($case_number, 'case_number')
				->select($seller_id, 'seller_id')
				->type($selling_price, 'selling_price')
				->select($purchaser_id, 'purchaser_id')
				->type($purchase_price, 'purchase_price')
				->select($finance_status_id, 'finance_status_id')
				->select($seller_status_id, 'seller_status_id')
				->press('Add Property Flip')
				
				->see('Property Flip saved')
				->see($reference_number)
				->see($title_deed_number)
				->see($case_number)
					
				->visit('/search-property')
				->type($reference_number, 'reference_number')
				->press('Search')
				->see('Test address line 1000')
				
				->click('View')
				->see('View Property')
				
				->click('View')
				->see('View Property Flip')
				
				->click('General');
				
				//TODO: Can't get this part to work
// 				->click('Update Property Flip')
// 				->see('Update Property Flip')
// 				->type('ABC Updated', 'case_number')
// 				->press('Update Property Flip')
// 				->see('Property Flip updated')
// 				->see('ABC Updated');
	}
	
	/**
	 * Test searching for a property
	 */
	public function testAddPropertyFlipThenSearchPropertyThenUpdatePropertyFlip()
	{
		$property_id = $this->createProperty();
		
		$reference_number = 1104;
		$title_deed_number = 1104;
		$case_number = 'A1234';
		$seller_id = 1;
		$selling_price = 100000.00;
		$purchaser_id = 1;
		$purchase_price = 100000.00;
		$finance_status_id = 1;
		$seller_status_id = 1;
		$created_by_id = 1;
		
		$this->visit('/')
				->visit('/login')
				->type('jaco.wk@gmail.com', 'email')
				->type('password', 'password')
				->press('Login')
				->visit('/search-property')
					
				->type($property_id, 'property_id')
				->press('Search')
				->click('View')
				
				->press('Add Property Flip')
				->seePageIs('/add-property-flip/' . $property_id)
				->type($reference_number, 'reference_number')
				->type($title_deed_number, 'title_deed_number')
				->type($case_number, 'case_number')
				->select($seller_id, 'seller_id')
				->type($selling_price, 'selling_price')
				->select($purchaser_id, 'purchaser_id')
				->type($purchase_price, 'purchase_price')
				->select($finance_status_id, 'finance_status_id')
				->select($seller_status_id, 'seller_status_id')
				->press('Add Property Flip')
				
				->see('Property Flip saved')
				->see($reference_number)
				->see($title_deed_number)
				->see($case_number)
					
				->visit('/search-property')
				->type($reference_number, 'reference_number')
				->press('Search')
				->see('Test address line 1000')
				
				->click('View')
				->see('View Property')
				
				->click('Update')
				->see('Update Property Flip')
				->type('ABC Updated', 'case_number')
				->press('Update Property Flip')
				->see('Property Flip updated')
				->see('ABC Updated');
	}

	private function createProperty()
    {
		$address_line_1 = 'Test address line 1000';
    	$area_id = 1;
    	$greater_area_id = 1;
    	$portion_number = 1;
    	$erf_number = 10;
    	$size = 50;
    	$lookup_property_type_id = 1;
    	$created_by_id = 1;
    	
    	$property = new Property();
    	$property->address_line_1 = $address_line_1;
    	$property->area_id = $area_id;
    	$property->greater_area_id = $greater_area_id;
    	$property->portion_number = $portion_number;
    	$property->erf_number = $erf_number;
    	$property->size = $size;
    	$property->lookup_property_type_id = $lookup_property_type_id;
    	$property->created_by_id = $created_by_id;
    	$property->save();
    	return $property->id;
    }
}
