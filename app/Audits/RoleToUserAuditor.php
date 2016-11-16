<?php
namespace jericho\Audits;

use Illuminate\Http\Request;
use OwenIt\Auditing\Auditing;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use jericho\Permissions\PermissionArrayFilter;

/**
 * This class is used to log audits when roles are added to a attorney. Used in UserController.
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-27
 *
 */
class RoleToUserAuditor implements Auditor
{
	public function __construct($request, $user, $edited_user, $new_roles, $old_roles)
	{
		$this->request = $request;
		$this->user = $user;
		$this->edited_user = $edited_user;
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
		$auditing->auditable_id = $this->edited_user->id;
		$auditing->auditable_type = 'jericho\User';
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
			$filtered_old_roles = (new PermissionArrayFilter())->filter($this->old_roles, $this->new_roles);
			if ($filtered_old_roles)
			{
				$old_audit = 'Removed the user from the following roles:<br/>' .
						'<b>User:</b> ' . $this->edited_user->firstname . ' ' . $this->edited_user->surname . ' (ID: ' . $this->edited_user->id . '),<br/>';
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
			$filtered_new_roles = (new PermissionArrayFilter())->filter($this->new_roles, $this->old_roles);
			if ($filtered_new_roles)
			{
				$new_audit = 'Added the user to the following roles:<br/>' .
						'<b>User:</b> ' . $this->edited_user->firstname . ' ' . $this->edited_user->surname . ' (ID: ' . $this->edited_user->id . '),<br/>';
				foreach ($filtered_new_roles as $role)
				{
					$new_audit .= '<b>Role Name:</b> ' . $role->name . ' (ID: ' . $role->id . ')<br/>';
				}
				return $new_audit;
			}
		}
	}
}