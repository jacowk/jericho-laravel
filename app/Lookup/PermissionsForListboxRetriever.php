<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\Permission;
use jericho\Util\Util;
use DB;

/**
 * A component for retrieving permissions to be used for listboxes in a view.
 * This class is to prepare permissions for the bootstrap duallistbox, a javascript component. 
 * The constructor parameter, $existing_permissions, is used to pass in the existing permissions 
 * for a role, if an existing role is updated. All existing permissions are indicated as being 
 * "selected", for the purpose of the bootstrap duallistbox.
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class PermissionsForListboxRetriever implements Component
{
	public function __construct($existing_permissions = null)
	{
		$this->existing_permissions = $existing_permissions;
	}
	
	public function execute()
	{
		$lookup_permissions = Permission::orderBy('name', 'asc')->get();
								
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