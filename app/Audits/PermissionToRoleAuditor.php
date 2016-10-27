<?php
namespace jericho\Audits;

use Illuminate\Http\Request;
use OwenIt\Auditing\Auditing;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use jericho\Permissions\ArrayFilter;

/**
 * This class is used to log audits when roles are added to a permission. Used in RoleController.
 * If items are in old, but not in new, then it was removed, and should be in old.
 * If items are not in old, but in new, then it was added as new.
 * 
 * When a Role is stored in RoleController, first, all existing permissions are detached, then the new
 * permissions are attached. The array parameter in the constructor of this class called $old_permissions, and are
 * all permissions before detach. The array parameter in the constructor of this class called $new_permissions, and
 * are all new permissions that are attached. 
 * 
 * It is possible that permissions are duplicated in $old_permissions and $new_permissions, in the case where
 * a particular permission was added in the past, and not removed in an update.
 * 
 * In this auditor, the $old_permissions array should be filtered to only include permissions that are not in the
 * $new_permissions array. The $new_permissions array should be filtered to only include permissions that are not 
 * in the $old_permissions array.
 *
 * @author Jaco Koekemoer
 * Date: 2016-10-27
 *
 */
class PermissionToRoleAuditor implements Auditor
{
	public function __construct($request, $user, $role, $new_permissions, $old_permissions)
	{
		$this->request = $request;
		$this->user = $user;
		$this->role = $role;
		$this->new_permissions = $new_permissions;
		$this->old_permissions = $old_permissions;
	}

	public function log()
	{
		$old_audit = $this->buildOldAudit();
		$new_audit = $this->buildNewAudit();
		$auditing = new Auditing();
		$auditing->id = (string) Uuid::uuid4();
		$auditing->type = 'linked';
		$auditing->auditable_id = $this->role->id;
		$auditing->auditable_type = 'jericho\Role';
		$auditing->old = $old_audit;
		$auditing->new = $new_audit;
		$auditing->user_id = $this->user->id;
		$auditing->route = $this->request->fullUrl();
		$auditing->ip_address = $this->request->ip();
		$auditing->created_at = new Carbon();
		$auditing->save();
	}

	private function buildOldAudit()
	{
		if ($this->old_permissions)
		{
			$filtered_old_permissions = (new ArrayFilter())->filter($this->old_permissions, $this->new_permissions);
			if ($filtered_old_permissions)
			{
				$old_audit = 'Removed the following permissions from the role:<br/>' .
						'<b>Role:</b> ' . $this->role->name . ' (ID: ' . $this->role->id . '),<br/>';
				foreach ($filtered_old_permissions as $permission)
				{
					$old_audit .= '<b>Permission Name:</b> ' . $permission->name . ' (ID: ' . $permission->id . ')<br/>';
				}
				return $old_audit;
			}
		}
	}

	private function buildNewAudit()
	{
		if ($this->new_permissions)
		{
			$filtered_new_permissions = (new ArrayFilter())->filter($this->new_permissions, $this->old_permissions);
			if ($filtered_new_permissions)
			{
				$new_audit = 'Added the following permissions to the role:<br/>' .
						'<b>Role:</b> ' . $this->role->name . ' (ID: ' . $this->role->id . '),<br/>';
				foreach ($filtered_new_permissions as $permission)
				{
					$new_audit .= '<b>Permission Name:</b> ' . $permission->name . ' (ID: ' . $permission->id . ')<br/>';
				}
				return $new_audit;
			}
		}
	}
}