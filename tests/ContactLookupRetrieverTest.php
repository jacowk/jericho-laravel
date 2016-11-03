<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Lookup\ContactLookupRetriever;
use jericho\Contact;

/**
 * A unit test for ContactLookupRetriever
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class ContactLookupRetrieverTest extends TestCase
{
    public function testExecute()
    {
        $lookup_list = (new ContactLookupRetriever())->execute();
    	$this->assertNotNull($lookup_list);
    	$this->assertTrue(count($lookup_list) > 0);
    	foreach ($lookup_list as $key => $value)
    	{
    		if ($key > 0)
    		{
	    		$object = Contact::find((int) $key);
	    		$this->assertNotNull($object);
	    		$this->assertEquals($object->firstname . ' ' . $object->surname, $value);
    		}
    	}
    }
}
