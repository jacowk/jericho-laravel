<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Lookup\TransactionTypeLookupRetriever;
use jericho\LookupTransactionType;

/**
 * A unit test for TransactionTypeLookupRetriever
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class TransactionTypeLookupRetrieverTest extends TestCase
{
    public function testExecute()
    {
        $lookup_list = (new TransactionTypeLookupRetriever())->execute();
    	$this->assertNotNull($lookup_list);
    	$this->assertTrue(count($lookup_list) > 0);
    	foreach ($lookup_list as $key => $value)
    	{
    		if ($key > 0)
    		{
	    		$object = LookupTransactionType::find((int) $key);
	    		$this->assertNotNull($object);
	    		$this->assertEquals($object->description, $value);
    		}
    	}
    }
}
