<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Lookup\RolesForCheckboxesRetriever;
use jericho\Role;

/**
 * A unit test for AreaLookupRetriever
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class RolesForCheckboxesRetrieverTest extends TestCase
{
    public function testExecute()
    {
        $lookup_list = (new RolesForCheckboxesRetriever())->execute();
    	$this->assertNotNull($lookup_list);
    	$this->assertTrue(count($lookup_list) > 0);
    	foreach ($lookup_list as $key => $value)
    	{
    		if ($key > 0)
    		{
	    		$object = Role::find((int) $key);
	    		$this->assertNotNull($object);
	    		$this->assertEquals($object->name, $value['name']);
    		}
    	}
    }
}
