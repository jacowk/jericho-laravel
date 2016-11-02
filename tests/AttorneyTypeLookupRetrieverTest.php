<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Lookup\AttorneyTypeLookupRetriever;
use jericho\LookupAttorneyType;

/**
 * A unit test for AttorneyTypeLookupRetriever
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-02
 *
 */
class AttorneyTypeLookupRetrieverTest extends TestCase
{
    public function testExecute()
    {
        $lookup_list = (new AttorneyTypeLookupRetriever())->execute();
    	$this->assertNotNull($lookup_list);
    	$this->assertTrue(count($lookup_list) > 0);
    	foreach ($lookup_list as $key => $value)
    	{
    		if ($key > 0)
    		{
	    		$object = LookupAttorneyType::find((int) $key);
	    		$this->assertNotNull($object);
	    		$this->assertEquals($object->description, $value);
    		}
    	}
    }
}
