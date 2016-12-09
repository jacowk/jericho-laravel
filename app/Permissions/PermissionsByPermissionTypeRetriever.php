<?php
namespace jericho\Permissions;

use jericho\Component\Component;

/**
 * This class retrieves all permissions for a permission type
 * 
 * @author Jaco Koekemoer
 * Date: 2016-12-09
 *
 */
class PermissionsByPermissionTypeRetriever implements Component
{
	public function __construct($permission_type)
	{
		$this->permission_type = $permission_type;
	}
	
	public function execute()
	{
		$permission_type_object = LookupPermissionType::where('description', 'like', $this->permission_type)->first();
		$permissions = Permission::where('permission_type_id', '=', $permission_type_object->id)->get();
		return $permissions;
	}
}