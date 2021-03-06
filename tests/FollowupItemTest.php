<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Property;
use jericho\PropertyFlip;
use jericho\DiaryItem;

/**
 * Unit test for testing followup items for a property flip functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-30
 *
 */
class FollowupItemTest extends TestCase
{
    /**
	 * Test adding a followup item and then viewing it
	 */
	public function testAddFollowupItem()
	{
		$property_flip_id = $this->createPropertyFlip('Test address line 1000');
		$diary_item_id = $this->createDiaryItem($property_flip_id);
		
		$comment = 'This is a test followup item';
		
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
			->see('Diary')
		
			->click('diary-tab')
			->see('Diary Items')
			->click('view-diary-item')
			
			->press('Add Followup Item')
			->type($comment, 'comments')
			->press('Add Followup Item')
			->see('View Diary Item')
			->see('Followup Item added')
			->see($comment);
	}
	
	/**
	 * Test adding a followup item comment and then viewing it
	 */
	public function testAddViewFollowupItemComment()
	{
		$property_flip_id = $this->createPropertyFlip('Test address line 1000');
		$diary_item_id = $this->createDiaryItem($property_flip_id);
		
		$comment = 'This is a test followup item comment';
		
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
			->see('Followup')
			
			->click('diary-tab')
			->see('Diary Items')
			->click('view-diary-item')
				
			->press('Add Followup Item')
			->type($comment, 'comments')
			->press('Add Followup Item')
			->see('View Diary Item')
			->see('Followup Item added')
			->see($comment)
		
			->click('view-followup-item')
			->see('View Followup Item')
			->see($comment);
	}
	
	/**
	 * Test adding a milestone, then updating it from the Update hyper link on the list of followup item comments
	 */
	public function testAddViewUpdateMilestone()
	{
		$property_flip_id = $this->createPropertyFlip('Test address line 1000');
		$diary_item_id = $this->createDiaryItem($property_flip_id);
		
		$comment = 'This is a test followup item comment';
		
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
			->see('Followup')
				
			->click('diary-tab')
			->see('Diary Items')
			->click('view-diary-item')
			
			->press('Add Followup Item')
			->type($comment, 'comments')
			->press('Add Followup Item')
			->see('View Diary Item')
			->see('Followup Item added')
			->see($comment)
			
			->click('update-followup-item')
			->see('Update Followup Item')
			->type($comment . ' Updated', 'comments')
			->press('Update Followup Item')
			
			->see('Followup Item updated')
			->see('View Diary Item')
			->see($comment . ' Updated');
	}
	
	/**
	 * Test adding a milestone and then viewing it, then updating it
	 */
	public function testAddViewUpdateViewMilestone()
	{
		$property_flip_id = $this->createPropertyFlip('Test address line 1000');
		$diary_item_id = $this->createDiaryItem($property_flip_id);
		
		$comment = 'This is a test followup item comment';
		
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
			->see('Followup')
			
			->click('diary-tab')
			->see('Diary Items')
			->click('view-diary-item')
				
			->press('Add Followup Item')
			->type($comment, 'comments')
			->press('Add Followup Item')
			->see('View Diary Item')
			->see('Followup Item added')
			->see($comment)
				
			->click('view-followup-item')
			->see('View Followup Item')
			->see($comment)
			->press('Update Followup Item')
			
			->see('Update Followup Item')
			->type($comment . ' Updated', 'comments')
			->press('Update Followup Item')
				
			->see('Followup Item updated')
			->see('View Diary Item')
			->see($comment . ' Updated');
	}
	
	/**
	 * Create a property for this test
	 * @return Property
	 */
	private function createProperty($address)
	{
		$address_line_1 = $address;
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
	private function createPropertyFlip($address)
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
		$property_id = $this->createProperty($address);
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
	 * Create diary item
	 */
	private function createDiaryItem($property_flip_id)
	{
		$followup_date = '2016/11/30 13:00';
		$followup_user_id = 1;
		$comments = 'This is a test comment';
		$status_id = 1;
		$created_by_id = 1;
		
		$diary_item = new DiaryItem();
		$diary_item->followup_date = $followup_date;
		$diary_item->followup_user_id = $followup_user_id;
		$diary_item->comments = $comments;
		$diary_item->status_id = $status_id;
		$diary_item->property_flip_id = $property_flip_id;
		$diary_item->created_by_id = $created_by_id;
		$diary_item->save();
		return $diary_item->id;
	}
}
