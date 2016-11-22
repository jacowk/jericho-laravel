<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Property;
use jericho\PropertyFlip;

/**
 * Unit test for testing adding attorney's to a property flip functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-21
 *
 */
class AttorneyPropertyFlipTest extends TestCase
{
    public function testLinkAttorneyContact()
    {
    	$property_flip_id = $this->createPropertyFlip();
    	$this->visit('/')
	    	->visit('/login')
	    	->type('jaco.wk@gmail.com', 'email')
	    	->type('password', 'password')
	    	->press('Login')
	    	->visit('/search-property')
	    		
	    	->type($property_flip_id, 'property_flip_id')
	    	->press('Search')
	    	->click('View') //View Property
    	
    		->click('View') //View Property Flip
    		->see('View Property Flip')
    		->see('General')
    		->see('Attorneys')
    		->see('Estate Agents')
    		->see('Contractors')
    		->see('Banks')
    		->see('Investors')
    		->see('Milestones')
    		->see('Notes')
    		->see('Documents')
    		->see('Diary')
    		->see('Transactions')
    		
    		->click('Attorneys') //Attorney tab
    		->see('Firstname')
    		->see('Surname')
    		->press('Link Attorney Contact');
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
    
    private function createPropertyFlip()
    {
    	$reference_number = 1000;
		$title_deed_number = 1000;
		$case_number = 'A1234';
		$seller_id = 1;
		$selling_price = 100000.00;
		$purchaser_id = 1;
		$purchase_price = 100000.00;
		$finance_status_id = 1;
		$seller_status_id = 1;
		$property_id = $this->createProperty();
		$created_by_id = 1;
    	
    	$property_flip = new PropertyFlip();
    	$property_flip->reference_number = $reference_number;
    	$property_flip->title_deed_number = $title_deed_number;
    	$property_flip->case_number = $case_number;
    	$property_flip->seller_id = $seller_id;
    	$property_flip->selling_price = $selling_price;
    	$property_flip->purchaser_id = $purchaser_id;
    	$property_flip->purchase_price = $purchase_price;
    	$property_flip->finance_status_id = $finance_status_id;
    	$property_flip->seller_status_id = $seller_status_id;
    	$property_flip->property_id = $property_id;
    	$property_flip->created_by_id = $created_by_id;
    	$property_flip->save();
    	return $property_flip->id;
    }
}
