<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Permissions\PermissionConstants;
use jericho\Permissions\PermissionValidator;
use jericho\User;
use jericho\Role;

/**
 * A unit test class for testing PermissionValidator methods
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-17
 *
 */
class PermissionValidatorTest extends TestCase
{
	public function setUp()
	{
		parent::setUp();
		$this->artisan('db:seed');
	}
	
	public function tearDown()
	{
		$this->artisan('db:seed');
		parent::tearDown();
	}
	
    public function testHasPermissionWithValidData()
    {
    	$permission_name = PermissionConstants::ADD_ACCOUNT;
    	$user = $this->createUser();
    	$this->addUserToRole($user);
    	$condition = PermissionValidator::hasPermission($permission_name, $user);
		$this->assertTrue($condition);    	
    }
    
    public function testHasPermissionWithEmptyRoles()
    {
    	$permission_name = PermissionConstants::ADD_ACCOUNT;
    	$user = $this->createUser();
    	$condition = PermissionValidator::hasPermission($permission_name, $user);
		$this->assertFalse($condition);    	
    }
    
    public function testHasPermissionWithNullUser()
    {
    	$permission_name = PermissionConstants::ADD_ACCOUNT;
    	$user = null;
    	try
    	{
	    	$condition = PermissionValidator::hasPermission($permission_name, $user);
	    	$this->fail('Test fail for null user');
    	}
    	catch (Exception $e) {}
    }

    public function testHasPermissionWithNullName()
    {
    	$permission_name = null;
    	$user = $this->createUser();
    	$this->addUserToRole($user);
    	try
    	{
    		$condition = PermissionValidator::hasPermission($permission_name, $user);
    		$this->fail('Test fail for null permission name');
    	}
    	catch (Exception $e) {}
    }
    
    private function createUser()
    {
    	$user = new User();
    	$user->firstname = 'Test1';
    	$user->surname = 'Test1';
    	$user->email = 'test1@test1.co.za';
    	$user->password = bcrypt('password');
    	$user->pagination_size = 10;
    	$user->created_by_id = 1;
    	$user->save();
    	return $user;
    }
    
    private function addUserToRole($user)
    {
    	$role = Role::find(1);
    	$user->roles()->attach($role);
    }
}