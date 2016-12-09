<?php
namespace jericho\Permissions;

use jericho\Permission;
use jericho\LookupPermissionType;

/**
 * This class is used to retrieve permissions for a permission type, that are not assigned to 
 * a role.
 *
 * @author: Jaco Koekemoer
 * Date: 2016-12-09
 */
class ExcludedPermissionsByRoleByPermissionTypeRetriever implements Component
{
	public function __construct(Role $role, $permission_type)
	{
		$this->role = $role;
		$this->permission_type = $permission_type;
	}

	public function execute()
	{
// 		$all_permissions = 
		
		$permission_type_object = LookupPermissionType::where('description', 'like', $this->permission_type)
		->first();
		$permissions = Permission::where('role_id', '=', $role->id)
		->where('permission_type_id', '=', $permission_type_object->id)
		->get();
		return $permissions;
	}
}