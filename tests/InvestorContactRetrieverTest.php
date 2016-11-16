<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Contacts\InvestorContactRetriever;
use jericho\PropertyFlip;

/**
 * Unit test for InvestorContactRetriever
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-16
 *
 */
class InvestorContactRetrieverTest extends TestCase
{
    public function testExecuteWithValidData()
    {
        $property_flip_id = 1;
        $property_flip = PropertyFlip::find($property_flip_id);
        $investor_contact_retriever = new InvestorContactRetriever($property_flip);
        $investor_contacts = $investor_contact_retriever->execute();
        $this->assertNotNull($investor_contacts);
        $this->assertNotEmpty($investor_contacts);
    }
    
    public function testExecuteWithNullPropertyFlip()
    {
        $property_flip = null;
        $investor_contact_retriever = new InvestorContactRetriever($property_flip);
        try
        {
	        $investor_contacts = $investor_contact_retriever->execute();
	        $this->fail('The investor contacts should not be retrievable here');
        }
        catch (Exception $exception){}
    }
    
    public function testExecuteWithEmptyPropertyFlip()
    {
    	$property_flip = new PropertyFlip();
        $investor_contact_retriever = new InvestorContactRetriever($property_flip);
        try
        {
	        $investor_contacts = $investor_contact_retriever->execute();
	        $this->fail('The investor contacts should not be retrievable here');
        }
        catch (Exception $exception){}
    }
}
