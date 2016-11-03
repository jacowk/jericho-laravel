<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\Role;
use jericho\Util\Util;

/**
 * A component for retrieving roles to be used for checkboxes in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class RolesForCheckboxesRetriever implements Component
{
	public function __construct($existing_roles = null)
	{
		$this->existing_roles = $existing_roles;
	}
	
	public function execute()
	{
		$lookup_roles = Role::all();
		$roles = array();
		foreach($lookup_roles as $role)
		{
			$role_selected = false;
			if ($this->existing_roles)
			{
				foreach($this->existing_roles as $existing_role)
				{
					if ($role->id === $existing_role->id)
					{
						$role_selected = true;
						break;
					}
				}
			}
			$roles[$role->id] = array(
					"html_name" => Util::convertNameForForm($role->name),
					"name" => $role->name,
					"role_selected" => $role_selected
			);
		}
		return $roles;
	}
}