<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Roles\RoleValidator;
use jericho\User;
use jericho\Role;

/**
 * A unit test class for testing RoleValidator methods
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-17
 *
 */
class RoleValidatorTest extends TestCase
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
	
	public function testIsUserInSuperUserRoleWithUserInSuperUserRole()
	{
		$user = $this->createUser();
		$this->addUserToRole($user, 'Super User');
		$condition = RoleValidator::isUserInSuperUserRole($user);
		$this->assertTrue($condition);
	}
	
	public function testIsUserInSuperUserRoleWithUserNotInSuperUserRole()
	{
		$user = $this->createUser();
		$this->addUserToRole($user, 'Supervisor');
		$condition = RoleValidator::isUserInSuperUserRole($user);
		$this->assertFalse($condition);
	}
	
	public function testIsUserInSuperUserRoleWithUserNoRoles()
	{
		$user = $this->createUser();
		$condition = RoleValidator::isUserInSuperUserRole($user);
		$this->assertFalse($condition);
	}
	
	public function testIsUserInSuperUserRoleWithNullUser()
	{
		$user = null;
		try
		{
			$condition = RoleValidator::isUserInSuperUserRole($user);
			$this->fail('Test fail for null user');
		}
		catch(Exception $e){}
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
	
	private function addUserToRole($user, $role_name)
	{
		$role = Role::where('name', 'like', $role_name)->get();
		$user->roles()->attach($role);
	}
}
