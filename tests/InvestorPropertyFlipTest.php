<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Carbon\Carbon;
use jericho\Property;
use jericho\PropertyFlip;
use jericho\Contact;

/**
 * Unit test for testing adding investors to a property flip functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-30
 *
 */
class InvestorPropertyFlipTest extends TestCase
{
	/**
	 * Test linking an investor to a property flip
	 */
    public function testInvestorPropertyFlip()
    {
    	$property_flip_id = $this->createPropertyFlip();
    	$contact_id = $this->createContact();
    	
    	$this->visit('/')
	    	->visit('/login')
	    	->type('jaco.wk@gmail.com', 'email')
	    	->type('password', 'password')
	    	->press('Login')
	    	->see('Home')
	    	->visit('/search-property')
	    	 
	    	->type($property_flip_id, 'property_flip_id')
	    	->press('Search')
	    	->click('View') //View Property
	    	 
	    	->click('View') //View Property Flip
	    	->see('View Property Flip')
	    	->see('General')
	    	->see('Investors')
	    	
	    	->click('investors-tab')
	    	->see('Investors')
	    	->press('Link Investor Contact')
	    	
	    	->select($contact_id, 'contact_id')
	    	->type('1000000', 'investment_amount')
	    	->press('Link Investor Contact')
    	
    		->see('Property Flip')
    		->see('Investors')
    		->see('Jack')
    		->see('Sixpack');
    }
    
    /**
     * Create a property for this test
     * @return Property
     */
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
    
    /**
     * Create a property flip for this test
     * 
     * @return property flip id
     */
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
    
    /**
     * Create a contact for this test
     */
    private function createContact()
    {
    	/*
		title_id
		firstname
		surname
		home_tel_no
		work_tel_no
		cell_no
		fax_no
		personal_email
		work_email
		id_number
		passport_number
		marital_status_id
		tax_number
		sa_citizen
		created_by_id
		updated_by_id
		deleted_by_id
		created_at

    	*/
    	$title_id = 1;
    	$firstname = 'Jack';
    	$surname = 'Sixpack';
    	$work_tel_no = '(011) 555 4444';
    	$work_email = 'jack.sixpack@test.co.za';
    	$created_by_id = 1;
    	$created_at = new Carbon();
    	
    	$contact = Contact::create([
    		'title_id' => $title_id,
    		'firstname' => $firstname,
    		'surname' => $surname,
    		'work_tel_no' => $work_tel_no,
    		'work_email' => $work_email,
    		'created_by_id' => $created_by_id,
    		'created_at' => $created_at
    	]);
    	return $contact->id;
    }
}
