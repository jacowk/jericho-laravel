<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Contacts\BankContactRetriever;
use jericho\PropertyFlip;

/**
 * Unit test for BankContactRetriever
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-16
 *
 */
class BankContactRetrieverTest extends TestCase
{
    public function testExecuteWithValidData()
    {
        $property_flip_id = 1;
        $property_flip = PropertyFlip::find($property_flip_id);
        $bank_contact_retriever = new BankContactRetriever($property_flip);
        $bank_contacts = $bank_contact_retriever->execute();
        $this->assertNotNull($bank_contacts);
        $this->assertNotEmpty($bank_contacts);
    }
    
    public function testExecuteWithNullPropertyFlip()
    {
        $property_flip = null;
        $bank_contact_retriever = new BankContactRetriever($property_flip);
        try
        {
	        $bank_contacts = $bank_contact_retriever->execute();
	        $this->fail('The bank contacts should not be retrievable here');
        }
        catch (Exception $exception){}
    }
    
    public function testExecuteWithEmptyPropertyFlip()
    {
    	$property_flip = new PropertyFlip();
        $bank_contact_retriever = new BankContactRetriever($property_flip);
        try
        {
	        $bank_contacts = $bank_contact_retriever->execute();
	        $this->fail('The bank contacts should not be retrievable here');
        }
        catch (Exception $exception){}
    }
}
