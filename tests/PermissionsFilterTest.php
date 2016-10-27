<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Permission;
use jericho\Permissions\PermissionsFilter;

/**
 * A unit test for testing PermissionsFilter
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-27
 *
 */
class PermissionsFilterTest extends TestCase
{
    public function testFilter()
    {
		$permissions_array1 = array();
		array_push($permissions_array1, Permission::find(1));
		array_push($permissions_array1, Permission::find(2));
		array_push($permissions_array1, Permission::find(3));
		
		$permissions_array2 = array();
		array_push($permissions_array2, Permission::find(1));
		array_push($permissions_array2, Permission::find(2));
		array_push($permissions_array2, Permission::find(4));
		array_push($permissions_array2, Permission::find(5));
		
    	$permissionsFilter = new PermissionsFilter();
    	$result_array = $permissionsFilter->filter($permissions_array1, $permissions_array2);
        $this->assertEquals(2, count($result_array));
        $this->assertEquals(1, $result_array[0]->id);
        $this->assertEquals(2, $result_array[1]->id);
    }
}
