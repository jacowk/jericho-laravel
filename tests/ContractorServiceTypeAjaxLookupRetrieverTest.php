<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Lookup\ContractorServiceTypeAjaxLookupRetriever;
use jericho\LookupContractorType;

/**
 * A unit test for AreaLookupRetriever
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class ContractorServiceTypeAjaxLookupRetrieverTest extends TestCase
{
    public function testExecute()
    {
    	$contractor_id = 1;
        $lookup_list = (new ContractorServiceTypeAjaxLookupRetriever($contractor_id))->execute();
    	$this->assertNotNull($lookup_list);
    	$this->assertTrue(count($lookup_list) > 0);
    	foreach ($lookup_list as $key => $value)
    	{
    		if ($key > 0)
    		{
	    		$object = LookupContractorType::find((int) $key);
	    		$this->assertNotNull($object);
	    		$this->assertEquals($object->description, $value);
    		}
    	}
    }
}
