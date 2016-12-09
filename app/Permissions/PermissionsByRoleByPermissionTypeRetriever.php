<?php
namespace jericho\Permissions;

use jericho\Permission;
use jericho\LookupPermissionType;
use DB;

/**
 * This class is used to retrieve permissions by permission type, for a role.
 * The $role parameter is the role for which permissions will be retrieved.
 * The $permission_type is a description of the permission type for which permissions
 * will be retrieved for the role.
 * 
 * @author: Jaco Koekemoer
 * Date: 2016-12-09
 */
class PermissionsByRoleByPermissionTypeRetriever implements Component
{
	public function __construct(Role $role, $permission_type)
	{
		$this->role = $role;
		$this->permission_type = $permission_type;
	}
	
	public function execute()
	{
		$permission_type_object = LookupPermissionType::where('description', 'like', $this->permission_type)
									->first();
		$permissions = DB::table('permissions')
						->leftJoin('permission_role', 'permission_role.permission_id', '=', 'permissions.id')
						->leftJoin('roles', 'roles.id', '=', 'permission_role.role_id')
						->where('roles.id', '=', $this->role->id)
						->where('permissions.permission_type_id', '=', $permission_type_object->id)
						->select('permissions.description')
						->get();
									
// 		$permissions = Permission::where('role_id', '=', $role->id)
// 						->where('permission_type_id', '=', $permission_type_object->id)
// 						->get();
		return $permissions;
	}
}