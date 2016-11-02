<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Lookup\EstateAgentLookupRetriever;
use jericho\EstateAgent;

/**
 * A unit test for EstateAgentTypeLookupRetriever
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-02
 *
 */
class EstateAgentLookupRetrieverTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExecute()
    {
        $lookup_list = (new EstateAgentLookupRetriever())->execute();
    	$this->assertNotNull($lookup_list);
    	$this->assertTrue(count($lookup_list) > 0);
    	foreach ($lookup_list as $key => $value)
    	{
    		if ($key > 0)
    		{
    			$object = EstateAgent::find((int) $key);
    			$this->assertNotNull($object);
    			$this->assertEquals($object->name, $value);
    		}
    	}
    }
}
