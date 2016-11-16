<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Contacts\EstateAgentContactRetriever;
use jericho\PropertyFlip;

/**
 * Unit test for EstateAgentContactRetrieverTest
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-16
 *
 */
class EstateAgentContactRetrieverTest extends TestCase
{
    public function testExecuteWithValidData()
    {
        $property_flip_id = 1;
        $property_flip = PropertyFlip::find($property_flip_id);
        $estate_agent_contact_retriever = new EstateAgentContactRetriever($property_flip);
        $estate_agent_contacts = $estate_agent_contact_retriever->execute();
        $this->assertNotNull($estate_agent_contacts);
        $this->assertNotEmpty($estate_agent_contacts);
    }
    
    public function testExecuteWithNullPropertyFlip()
    {
        $property_flip = null;
        $estate_agent_contact_retriever = new EstateAgentContactRetriever($property_flip);
        try
        {
	        $estate_agent_contacts = $estate_agent_contact_retriever->execute();
	        $this->fail('The estate_agent contacts should not be retrievable here');
        }
        catch (Exception $exception){}
    }
    
    public function testExecuteWithEmptyPropertyFlip()
    {
    	$property_flip = new PropertyFlip();
        $estate_agent_contact_retriever = new EstateAgentContactRetriever($property_flip);
        try
        {
	        $estate_agent_contacts = $estate_agent_contact_retriever->execute();
	        $this->fail('The estate agent contacts should not be retrievable here');
        }
        catch (Exception $exception){}
    }
}
