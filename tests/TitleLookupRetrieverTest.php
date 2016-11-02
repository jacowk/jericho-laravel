<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Lookup\TitleLookupRetriever;
use jericho\LookupTitle;

/**
 * A unit test for TitleLookupRetriever
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-02
 *
 */
class TitleLookupRetrieverTest extends TestCase
{
    public function testExecute()
    {
        $lookup_list = (new TitleLookupRetriever())->execute();
    	$this->assertNotNull($lookup_list);
    	$this->assertTrue(count($lookup_list) > 0);
    	foreach ($lookup_list as $key => $value)
    	{
    		if ($key > 0)
    		{
	    		$object = LookupTitle::find((int) $key);
	    		$this->assertNotNull($object);
	    		$this->assertEquals($object->description, $value);
    		}
    	}
    }
}
