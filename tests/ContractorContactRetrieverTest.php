<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Contacts\ContractorContactRetriever;
use jericho\PropertyFlip;

/**
 * Unit test for ContractorContactRetriever
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-16
 *
 */
class ContractorContactRetrieverTest extends TestCase
{
    public function testExecuteWithValidData()
    {
        $property_flip_id = 1;
        $property_flip = PropertyFlip::find($property_flip_id);
        $contractor_contact_retriever = new ContractorContactRetriever($property_flip);
        $contractor_contacts = $contractor_contact_retriever->execute();
        $this->assertNotNull($contractor_contacts);
        $this->assertNotEmpty($contractor_contacts);
    }
    
    public function testExecuteWithNullPropertyFlip()
    {
        $property_flip = null;
        $contractor_contact_retriever = new ContractorContactRetriever($property_flip);
        try
        {
	        $contractor_contacts = $contractor_contact_retriever->execute();
	        $this->fail('The contractor contacts should not be retrievable here');
        }
        catch (Exception $exception){}
    }
    
    public function testExecuteWithEmptyPropertyFlip()
    {
    	$property_flip = new PropertyFlip();
        $contractor_contact_retriever = new ContractorContactRetriever($property_flip);
        try
        {
	        $contractor_contacts = $contractor_contact_retriever->execute();
	        $this->fail('The contractor contacts should not be retrievable here');
        }
        catch (Exception $exception){}
    }
}
