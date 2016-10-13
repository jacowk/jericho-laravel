<?php
namespace jericho\Permissions;

use Illuminate\Support\Facades\Auth;

/**
 * This class is used to determine if a use has permission to access the given permission
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-05
 *
 */
class PermissionValidator
{
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
}