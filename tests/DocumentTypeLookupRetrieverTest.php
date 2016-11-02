<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Lookup\DocumentTypeLookupRetriever;
use jericho\LookupDocumentType;

/**
 * A unit test for DocumentTypeLookupRetriever
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-02
 *
 */
class DocumentTypeLookupRetrieverTest extends TestCase
{
    public function testExecute()
    {
        $lookup_list = (new DocumentTypeLookupRetriever())->execute();
    	$this->assertNotNull($lookup_list);
    	$this->assertTrue(count($lookup_list) > 0);
    	foreach ($lookup_list as $key => $value)
    	{
    		if ($key > 0)
    		{
	    		$object = LookupDocumentType::find((int) $key);
	    		$this->assertNotNull($object);
	    		$this->assertEquals($object->description, $value);
    		}
    	}
    }
}
