<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\Permission;
use jericho\LookupPermissionType;
use jericho\Util\Util;

/**
 * A component for retrieving permissions by permission type to be used for list boxes in a view.
 * This class is to prepare permissions for the bootstrap duallistbox, a javascript component. 
 * The constructor parameter, $existing_permissions, is used to pass in the existing permissions 
 * for a role for the provided permission type, if an existing role is updated. All existing permissions are 
 * indicated as being "selected", for the purpose of the bootstrap duallistbox.
 * 
 * The constructor parameter $permission_type, is a string description derived from the constant
 * class PermissionTypeConstants, containing the type of permissions, for which this class
 * should retrieve permissions for. 
 *
 * @author Jaco Koekemoer
 * Date: 2016-12-09
 *
 */
class PermissionsByPermissionTypeForListboxRetriever implements Component
{
	public function __construct($permission_type, $existing_permissions = null)
	{
		$this->existing_permissions = $existing_permissions;
		$this->permission_type = $permission_type;
	}
	
	public function execute()
	{
		/* Retrieve the permission type object */
		$permission_type_object = LookupPermissionType::where('description', 'like', $this->permission_type)->first();
		/* Retrieve permissions by permission type id */
		$lookup_permissions = Permission::where('permission_type_id', '=', $permission_type_object->id)
								->orderBy('name', 'asc')->get();
		
		$permissions = array();
		foreach($lookup_permissions as $permission)
		{
			$permission_selected = false;
			if ($this->existing_permissions)
			{
				foreach($this->existing_permissions as $existing_permission)
				{
					if ($permission->id === $existing_permission->id)
					{
						$permission_selected = true;
						break;
					}
				}
			}
			$permissions[$permission->id] = array(
				"html_name" => Util::convertNameForForm($permission->name),
				"name" => $permission->name,
				"permission_selected" => $permission_selected
			);
		}
		return $permissions;
	}
}