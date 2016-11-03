<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Lookup\BankLookupRetriever;
use jericho\Bank;

/**
 * A unit test for BankLookupRetriever
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class BankLookupRetrieverTest extends TestCase
{
    public function testExecute()
    {
        $lookup_list = (new BankLookupRetriever())->execute();
    	$this->assertNotNull($lookup_list);
    	$this->assertTrue(count($lookup_list) > 0);
    	foreach ($lookup_list as $key => $value)
    	{
    		if ($key > 0)
    		{
	    		$object = Bank::find((int) $key);
	    		$this->assertNotNull($object);
	    		$this->assertEquals($object->name, $value);
    		}
    	}
    }
}
