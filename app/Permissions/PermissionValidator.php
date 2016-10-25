<?php
namespace jericho\Permissions;

use Illuminate\Support\Facades\Auth;
use jericho\Role;

/**
 * This class is used to determine if a use has permission to access the given permission
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-05
 *
 */
class PermissionValidator
{
	/**
	 * Determine if the current user has the specified permission in any of the roles that user belongs to.
	 * 
	 * @param unknown $permission_name
	 * @return boolean
	 */
	public static function hasPermission($permission_name)
	{
		//Get the user
		$user = Auth::user();
		 
		//Get the roles
		$roles = $user->roles;
		 
		//Loop through roles, and check if the permission belongs to any of the roles
		$user_has_permission = false;
		foreach($roles as $role)
		{
			$permissions = $role->permissions;
			foreach($permissions as $permission)
			{
				if ($permission->name === $permission_name)
				{
					$user_has_permission = true;
					break;
				}
			}
			if ($user_has_permission)
			{
				break;
			}
		}
		return $user_has_permission;
	}
	
	/**
	 * Determine if the current user is in the super user role
	 * @return boolean
	 */
	public static function isUserInSuperUserRole()
	{
		//Get the user
		$user = Auth::user();
		
		//Get Super User role
		$super_user_role = Role::where('name', 'like', 'Super User')->first();
		
		//Loop through roles, to determine if the user belongs to the Super User role
		foreach ($user->roles as $user_role)
		{
			if ($user_role->id === $super_user_role->id)
			{
				return true;
			}
		}
		return false;
	}
}