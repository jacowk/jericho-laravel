<?php
namespace jericho\Permissions;

use jericho\Component\Component;
use jericho\LookupPermissionType;

/**
 * Given a list of permissions, and a permission type, return only the permissions that is of the given
 * permission type (Which is a string)
 * 
 * @author Jaco Koekemoer
 * Date: 2016-12-09
 */
class PermissionTypeFilter implements Component
{
	
	public function __construct($permissions, $permission_type)
	{
		$this->permissions = $permissions;
		$this->permission_type = $permission_type;
	}
	
	public function execute()
	{
		$filtered_permissions = array();
		if ($this->permissions)
		{
			$permission_type_object = LookupPermissionType::where('description', 'like', $this->permission_type)->first();
			foreach($this->permissions as $permission)
			{
				if ($permission->permission_type_id === $permission_type_object->id)
				{
					array_push($filtered_permissions, $permission);
				}
			}
		}
		return $filtered_permissions;
	}
}