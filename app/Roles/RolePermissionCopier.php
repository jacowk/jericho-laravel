<?php
namespace jericho\Roles;

use jericho\Role;
use jericho\Permission;

/**
 * This class takes all permissions from one role, and copy's it to another role
 * 
 * @author Jaco Koekemoer
 * Date: 2016-12-08
 */
class RolePermissionCopier
{
	public function __construct(Role $fromRole, Role $toRole)
	{
		$this->fromRole = $fromRole;
		$this->toRole = $toRole;
	}
	
	public function copyRolePermissions()
	{
		$this->toRole->permissions()->detach();
		foreach($this->fromRole->permissions()->get() as $permission)
		{
			$this->toRole->permissions()->attach($permission);
		}
	}
}