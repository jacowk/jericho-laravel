<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\Permission;
use jericho\Util\Util;

/**
 * A component for retrieving permissions to be used for checkboxes in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class PermissionsForCheckboxesRetriever implements Component
{
	public function __construct($existing_permissions = null)
	{
		$this->existing_permissions = $existing_permissions;
	}
	
	public function execute()
	{
		$lookup_permissions = Permission::all();
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