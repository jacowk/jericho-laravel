<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Lookup\UserLookupRetriever;
use jericho\User;

/**
 * A unit test for UserLookupRetriever
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class UserLookupRetrieverTest extends TestCase
{
    public function testExecute()
    {
        $lookup_list = (new UserLookupRetriever())->execute();
    	$this->assertNotNull($lookup_list);
    	$this->assertTrue(count($lookup_list) > 0);
    	foreach ($lookup_list as $key => $value)
    	{
    		if ($key > 0)
    		{
	    		$object = User::find((int) $key);
	    		$this->assertNotNull($object);
	    		$this->assertEquals($object->firstname . ' ' . $object->surname, $value);
    		}
    	}
    }
}
