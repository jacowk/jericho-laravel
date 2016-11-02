<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Lookup\MaritalStatusLookupRetriever;
use jericho\LookupMaritalStatus;

/**
 * A unit test for MaritalStatusLookupRetriever
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-02
 *
 */
class MaritalStatusLookupRetrieverTest extends TestCase
{
    public function testExecute()
    {
        $lookup_list = (new MaritalStatusLookupRetriever())->execute();
    	$this->assertNotNull($lookup_list);
    	$this->assertTrue(count($lookup_list) > 0);
    	foreach ($lookup_list as $key => $value)
    	{
    		if ($key > 0)
    		{
	    		$object = LookupMaritalStatus::find((int) $key);
	    		$this->assertNotNull($object);
	    		$this->assertEquals($object->description, $value);
    		}
    	}
    }
}
