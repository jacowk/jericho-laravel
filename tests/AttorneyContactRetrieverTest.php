<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Contacts\AttorneyContactRetriever;
use jericho\PropertyFlip;

/**
 * Unit test for AttorneyContactRetriever
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-16
 *
 */
class AttorneyContactRetrieverTest extends TestCase
{
    public function testExecuteWithValidData()
    {
        $property_flip_id = 1;
        $property_flip = PropertyFlip::find($property_flip_id);
        $attorney_contact_retriever = new AttorneyContactRetriever($property_flip);
        $attorney_contacts = $attorney_contact_retriever->execute();
        $this->assertNotNull($attorney_contacts);
        $this->assertNotEmpty($attorney_contacts);
    }
    
    public function testExecuteWithNullPropertyFlip()
    {
        $property_flip = null;
        $attorney_contact_retriever = new AttorneyContactRetriever($property_flip);
        try
        {
	        $attorney_contacts = $attorney_contact_retriever->execute();
	        $this->fail('The attorney contacts should not be retrievable here');
        }
        catch (Exception $exception){}
    }
    
    public function testExecuteWithEmptyPropertyFlip()
    {
    	$property_flip = new PropertyFlip();
        $attorney_contact_retriever = new AttorneyContactRetriever($property_flip);
        try
        {
	        $attorney_contacts = $attorney_contact_retriever->execute();
	        $this->fail('The attorney contacts should not be retrievable here');
        }
        catch (Exception $exception){}
    }
}
