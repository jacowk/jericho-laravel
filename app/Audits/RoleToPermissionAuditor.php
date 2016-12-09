<?php
namespace jericho\Audits;

use Illuminate\Http\Request;
use OwenIt\Auditing\Auditing;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use jericho\Permissions\PermissionArrayFilter;

/**
 * This class is used to log audits when roles are added to a permission. Used in PermissionController.
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-27
 *
 */
class RoleToPermissionAuditor implements Auditor
{
	public function __construct($request, $user, $permission, $new_roles, $old_roles)
	{
		$this->request = $request;
		$this->user = $user;
		$this->permission = $permission;
		$this->new_roles = $new_roles;
		$this->old_roles = $old_roles;
	}
	
	public function log()
	{
		$old_audit = $this->buildOldAudit();
		$new_audit = $this->buildNewAudit();
		$auditing = new Auditing();
		$auditing->id = (string) Uuid::uuid4();
		$auditing->type = 'linked';
		$auditing->auditable_id = $this->permission->id;
		$auditing->auditable_type = 'jericho\Permission';
		$auditing->old = $old_audit;
		$auditing->new = $new_audit;
		$auditing->user_id = $this->user->id;
		$auditing->route = $this->request->fullUrl();
		$auditing->ip_address = $this->request->ip();
		$auditing->created_at = new Carbon();
		$auditing->save();
	}
	
	private function buildoldAudit()
	{
		if ($this->old_roles)
		{
			$filtered_old_roles = (new PermissionArrayFilter($this->old_roles, $this->new_roles))->execute();
			if ($filtered_old_roles)
			{
				$old_audit = 'Removed the following roles from the permission:<br/>' .
						'<b>Permission:</b> ' . $this->permission->name . ' (ID: ' . $this->permission->id . '),<br/>';
				foreach ($filtered_old_roles as $role)
				{
					$old_audit .= '<b>Role Name:</b> ' . $role->name . ' (ID: ' . $role->id . ')<br/>';
				}
				return $old_audit;
			}
		}
	}
	
	private function buildNewAudit()
	{
		if ($this->new_roles)
		{
			$filtered_new_roles = (new PermissionArrayFilter($this->new_roles, $this->old_roles))->execute();
			if ($filtered_new_roles)
			{
				$new_audit = 'Added the following roles to the permission:<br/>' .
						'<b>Permission:</b> ' . $this->permission->name . ' (ID: ' . $this->permission->id . '),<br/>';
				foreach ($filtered_new_roles as $role)
				{
					$new_audit .= '<b>Role Name:</b> ' . $role->name . ' (ID: ' . $role->id . ')<br/>';
				}
				return $new_audit;
			}
		}
	}
}