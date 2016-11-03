<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Lookup\AttorneyLookupRetriever;
use jericho\Attorney;

/**
 * A unit test for AttorneyLookupRetriever
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class AttorneyLookupRetrieverTest extends TestCase
{
    public function testExecute()
    {
        $lookup_list = (new AttorneyLookupRetriever())->execute();
    	$this->assertNotNull($lookup_list);
    	$this->assertTrue(count($lookup_list) > 0);
    	foreach ($lookup_list as $key => $value)
    	{
    		if ($key > 0)
    		{
	    		$object = Attorney::find((int) $key);
	    		$this->assertNotNull($object);
	    		$this->assertEquals($object->name, $value);
    		}
    	}
    }
}
