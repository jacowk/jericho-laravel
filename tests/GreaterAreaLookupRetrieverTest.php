<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Lookup\GreaterAreaLookupRetriever;
use jericho\GreaterArea;

/**
 * A unit test for GreaterAreaLookupRetriever
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class GreaterAreaLookupRetrieverTest extends TestCase
{
    public function testExecute()
    {
        $lookup_list = (new GreaterAreaLookupRetriever())->execute();
    	$this->assertNotNull($lookup_list);
    	$this->assertTrue(count($lookup_list) > 0);
    	foreach ($lookup_list as $key => $value)
    	{
    		if ($key > 0)
    		{
	    		$object = GreaterArea::find((int) $key);
	    		$this->assertNotNull($object);
	    		$this->assertEquals($object->name, $value);
    		}
    	}
    }
}
