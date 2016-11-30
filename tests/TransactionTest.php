<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\LookupTransactionType;
use jericho\Property;
use jericho\PropertyFlip;
use Carbon\Carbon;
use jericho\Account;

/**
 * Unit test for testing transaction for a property flip functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-30
 *
 */
class TransactionTest extends TestCase
{
    /**
     * Test adding a transaction and then viewing it
     */
    public function testAddTransaction()
    {
    	$property_flip_id = $this->createPropertyFlip('Test address line 1000');
    	$transaction_type_description = 'Test Transaction Type 1';
    	$transaction_type_id = $this->createTestTransactionType($transaction_type_description);
    	
    	$account_name = 'Account ABC';
    	$account_id = $this->createTestAccount($account_name);
    	
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
	    	
	    	->click('transactions-tab')
    		->see('Transactions')
    		->press('Add Transaction')
    		->type('2016-11-30', 'effective_date')
    		->type('Test Description', 'description')
    		->type('Test Reference', 'reference')
    		->select($account_id, 'account_id')
    		->select($transaction_type_id, 'transaction_type_id')
    		->type('1000000', 'debit_amount')
    		->press('Add Transaction')
    		
    		->see('View Property Flip')
    		->see('Transactions')
    		->see($account_name)
    		->see($transaction_type_description);
    }
    
    /**
     * Test adding a transaction and then viewing it
     */
    public function testAddViewTransaction()
    {
    	$property_flip_id = $this->createPropertyFlip('Test address line 1000');
    	$transaction_type_description = 'Test Transaction Type 1';
    	$transaction_type_id = $this->createTestTransactionType($transaction_type_description);
    	 
    	$account_name = 'Account ABC';
    	$account_id = $this->createTestAccount($account_name);
    	 
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
	    	
	    	->click('transactions-tab')
	    	->see('Transactions')
	    	->press('Add Transaction')
	    	->type('2016-11-30', 'effective_date')
	    	->type('Test Description', 'description')
	    	->type('Test Reference', 'reference')
	    	->select($account_id, 'account_id')
	    	->select($transaction_type_id, 'transaction_type_id')
	    	->type('1000000', 'debit_amount')
	    	->press('Add Transaction')
	    	
	    	->see('View Property Flip')
	    	->see('Transactions')
	    	->see($account_name)
	    	->see($transaction_type_description)
    	
    		->click('view-transaction')
    		->see('View Transaction')
    		->see($account_name)
    		->see($transaction_type_description);
    }
    
    /**
     * Test adding a milestone and then viewing and updating it
     */
    public function testAddViewUpdateMilestone()
    {
    	$property_flip_id = $this->createPropertyFlip('Test address line 1000');
    	
    	$transaction_type_description = 'Test Transaction Type 1';
    	$transaction_type_id = $this->createTestTransactionType($transaction_type_description);
    	
    	$transaction_type_description2 = 'Test Transaction Type 2';
    	$transaction_type_id2 = $this->createTestTransactionType($transaction_type_description2);
    	
    	$account_name = 'Account ABC';
    	$account_id = $this->createTestAccount($account_name);
    	
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
	    	
	    	->click('transactions-tab')
	    	->see('Transactions')
	    	->press('Add Transaction')
	    	->type('2016-11-30', 'effective_date')
	    	->type('Test Description', 'description')
	    	->type('Test Reference', 'reference')
	    	->select($account_id, 'account_id')
	    	->select($transaction_type_id, 'transaction_type_id')
	    	->type('1000000', 'debit_amount')
	    	->press('Add Transaction')
	    	
	    	->see('View Property Flip')
	    	->see('Transactions')
	    	->see($account_name)
	    	->see($transaction_type_description)
	    	 
	    	->click('view-transaction')
	    	->see('View Transaction')
	    	->see($account_name)
	    	->see($transaction_type_description)
    	
    		->press('Update Transaction')
    		->see('Update Transaction')
    		->select($transaction_type_id2, 'transaction_type_id')
    		->type('2000000', 'debit_amount')
    		->press('Update Transaction')
    		
    		->see('View Property Flip')
    		->see('Transactions')
    		->see('Transaction updated')
    		->see($transaction_type_description2);
    }
    
    /**
     * Test adding a milestone and then updating it from the list
     */
    public function testAddViewUpdateViewTransaction()
    {
    	$property_flip_id = $this->createPropertyFlip('Test address line 1000');
    	 
    	$transaction_type_description = 'Test Transaction Type 1';
    	$transaction_type_id = $this->createTestTransactionType($transaction_type_description);
    	 
    	$transaction_type_description2 = 'Test Transaction Type 2';
    	$transaction_type_id2 = $this->createTestTransactionType($transaction_type_description2);
    	 
    	$account_name = 'Account ABC';
    	$account_id = $this->createTestAccount($account_name);
    	 
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
    
    	->click('transactions-tab')
    	->see('Transactions')
    	->press('Add Transaction')
    	->type('2016-11-30', 'effective_date')
    	->type('Test Description', 'description')
    	->type('Test Reference', 'reference')
    	->select($account_id, 'account_id')
    	->select($transaction_type_id, 'transaction_type_id')
    	->type('1000000', 'debit_amount')
    	->press('Add Transaction')
    
    	->see('View Property Flip')
    	->see('Transactions')
    	->see($account_name)
    	->see($transaction_type_description)
    	 
    	->click('update-transaction')
    	->see('Update Transaction')
    	->select($transaction_type_id2, 'transaction_type_id')
    	->type('2000000', 'debit_amount')
    	->press('Update Transaction')
    
    	->see('View Property Flip')
    	->see('Transactions')
    	->see('Transaction updated')
    	->see($transaction_type_description2);
    }
    
    /**
     * Create a property for this test
     * 
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
     * Create a lookup transaction type for this test
     *
     * @return \jericho\LookupTransactionType
     */
    private function createTestTransactionType($transaction_type_description)
    {
    	$description = $transaction_type_description;
    	$created_at = new Carbon();
    	$created_by_id = 1;
    	 
    	$transaction_type = LookupTransactionType::create(
    	[
    		'description' => $description,
    		'created_at' => $created_at,
    		'created_by_id' => $created_by_id
    	]);
    	return $transaction_type->id;
    }

    /**
     * Create a test account for this test
     *
     * @return \jericho\Account
     */
    private function createTestAccount($account_name)
    {
    	$name = $account_name;
    	$created_at = new Carbon();
    	$created_by_id = 1;
    
    	$account = Account::create(
    	[
    		'name' => $name,
    		'created_at' => $created_at,
    		'created_by_id' => $created_by_id
    	]);
    	return $account->id;
    }
}
