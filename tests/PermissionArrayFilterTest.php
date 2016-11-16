<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Permissions\PermissionArrayFilter;
use jericho\Permission;

/**
 * Unit test for PermissionArrayFilter
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-16
 *
 */
class PermissionArrayFilterTest extends TestCase
{
    public function testFilterWithValidData()
    {
    	$array1 = array();
    	$permission1 = Permission::find(1);
    	$permission2 = Permission::find(2);
    	$permission3 = Permission::find(3);
    	array_push($array1, $permission1);
    	array_push($array1, $permission2);
    	array_push($array1, $permission3);
    	
    	$array2 = array();
    	array_push($array2, $permission1);
    	array_push($array2, $permission2);
    	
    	$permission_array_filter = new PermissionArrayFilter();
    	$filtered_array = $permission_array_filter->filter($array1, $array2);
    	
    	/* Validate filtered array */
    	$this->assertNotNull($filtered_array);
    	$this->assertNotEmpty($filtered_array);
		$this->assertTrue(count($filtered_array) == 1);
		$found = false;
		foreach($filtered_array as $permission)
		{
			if ($permission->id = $permission3->id)
			{
				$found = true;
				break;
			}
		}
		$this->assertTrue($found);
    }
    
    public function testFilterWithNullArray1()
    {
    	$array1 = null;
    	$permission1 = Permission::find(1);
    	$permission2 = Permission::find(2);
    	
    	$array2 = array();
    	array_push($array2, $permission1);
    	array_push($array2, $permission2);
    	
    	$permission_array_filter = new PermissionArrayFilter();
    	$filtered_array = $permission_array_filter->filter($array1, $array2);
    	
    	/* Validate filtered array */
    	$this->assertEmpty($filtered_array);
    }
    
    public function testFilterWithNullArray2()
    {
    	$array1 = array();
    	$permission1 = Permission::find(1);
    	$permission2 = Permission::find(2);
    	$permission3 = Permission::find(3);
    	array_push($array1, $permission1);
    	array_push($array1, $permission2);
    	array_push($array1, $permission3);
    	 
    	$array2 = null;
    	 
    	$permission_array_filter = new PermissionArrayFilter();
    	$filtered_array = $permission_array_filter->filter($array1, $array2);
    	 
    	/* Validate filtered array */
    	$this->assertNotNull($filtered_array);
    	$this->assertNotEmpty($filtered_array);
    	$this->assertTrue(count($filtered_array) == 3);
    }
}
