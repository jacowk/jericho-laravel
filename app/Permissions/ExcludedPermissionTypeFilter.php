<?php
namespace jericho\Permissions;

use jericho\Component\Component;
use jericho\LookupPermissionType;

/**
 * Given a list of all permissions, and a permission type, return only the permissions that is of the given
 * permission type, and that is not in the list of existing permissions
 *
 * @author Jaco Koekemoer
 * Date: 2016-12-09
 */
class ExcludedPermissionTypeFilter implements Component
{

	public function __construct($all_permissions, $existing_permissions, $permission_type)
	{
		$this->all_permissions = $all_permissions;
		$this->existing_permissions = $existing_permissions;
		$this->permission_type = $permission_type;
	}

	public function execute()
	{
		$filtered_permissions = array();
		$permission_type_object = LookupPermissionType::where('description', 'like', $this->permission_type)->first();
		foreach($this->all_permissions as $permission)
		{
			$permission_found = false;
			foreach ($this->existing_permissions as $existing_permission)
			{
				if ($permission->permission_type_id === $permission_type_object->id &&
						$permission->id === $existing_permission->id)
				{
					$permission_found = true;
					break;
				}
			}
			if (!$permission_found)
			{
				array_push($filtered_permissions, $permission);
			}
		}
		return $filtered_permissions;
	}
}