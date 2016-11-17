<?php
namespace jericho\Roles;

use Illuminate\Support\Facades\Auth;
use jericho\Role;
use Exception;

/**
 * This class is used to validate user roles
 * 
 * @author Jaco Koekemoer
 * Date: 2016-1-17
 *
 */
class RoleValidator
{
	/**
	 * Determine if the current user is in the super user role
	 * @return boolean
	 */
	public static function isUserInSuperUserRole($user = null)
	{
		//Get the user
		if ($user == null)
		{
			$user = Auth::user();
			if ($user == null)
			{
				throw new Exception('A user must be provided to validate the superuser role');
			}
		}
	
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