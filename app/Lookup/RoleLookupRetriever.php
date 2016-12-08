<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\Role;

/**
 * A component for retrieving roles to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-12-08
 *
 */
class RoleLookupRetriever implements Component
{
	public function execute()
	{
		$lookup_roles = Role::orderBy('id', 'asc')->get();
		$roles = array();
		$roles[-1] = "Select Role";
		foreach($lookup_roles as $role)
		{
			$roles[$role->id] = $role->name;
		}
		return $roles;
	}
}