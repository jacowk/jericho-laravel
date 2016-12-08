<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\Role;
use jericho\Permission;
use jericho\Util\Util;
use jericho\Audits\PermissionToRoleAuditor;
use jericho\Lookup\PermissionsForCheckboxesRetriever;
use jericho\Http\Controllers\Auth\AuthUserRetriever;
use jericho\Validation\UpdateObjectValidator;
use jericho\Validation\ViewObjectValidator;
use jericho\Lookup\RoleLookupRetriever;
use jericho\Roles\RolePermissionCopier;

/**
 * This class is a controller for performing CRUD operations on roles
 *
 * @author Jaco Koekemoer
 * Date: 2016-09-29
 *
 */
class RoleController extends Controller
{
	/**
	 * Load search page
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getSearchRole()
	{
		return view('role.search-role', [
			'name' => null
		]);
	}
	
	/**
	 * Search for roles
	 *
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function postDoSearchRole(Request $request)
	{
		$user = (new AuthUserRetriever())->retrieveUser();
		$name = null;
		if (Util::isValidRequestVariable($request->name))
		{
			$name = $request->name;
			$roles = Role::where('name', 'like', '%' . $name . '%')->orderBy('id', 'asc')->paginate($user->pagination_size);
		}
		else
		{
			$roles = Role::orderBy('id', 'asc')->paginate($user->pagination_size);
		}
		return view('role.search-role', [
			'roles' => $roles,
			'name' => $name
		]);
	}
	
	/**
	 * Load page to add a role
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddRole()
	{
		$permissions = (new PermissionsForCheckboxesRetriever())->execute();
		return view('role.add-role', ['permissions' => $permissions]);
	}
	
	/**
	 * Add a role
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddRole(Request $request)
	{
		$validator = Validator::make($request->all(), [
				'name' => 'required|unique:roles'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('add-role')
				->withErrors($validator)
				->withInput();
		}
		$user = (new AuthUserRetriever())->retrieveUser();
		$role = new Role();
		$role->name = Util::getQueryParameter($request->name);
		$role->created_by_id = $user->id;
		$role->save();
		$this->processPermissions($request, $role);
		return redirect()->action('RoleController@getViewRole', ['role_Id' => $role->id])
		->with(['message' => 'Role saved']);
	}
	
	/**
	 * Load page to update an role
	 *
	 * @param Request $request
	 * @param unknown $role_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdateRole(Request $request, $role_id)
	{
		$role = Role::find($role_id);
		(new UpdateObjectValidator())->validate($role, 'role', $role_id);
		$permissions = (new PermissionsForCheckboxesRetriever($role->permissions))->execute();
		return view('role.update-role', ['role' => $role, 'permissions' => $permissions]);
	}
	
	/**
	 * Update an role
	 *
	 * @param Request $request
	 * @param unknown $role_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdateRole(Request $request, $role_id)
	{
		$validator = Validator::make($request->all(), [
				'name' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('update-role', ['role_id' => $role_id])
				->withErrors($validator)
				->withInput();
		}
		$user = (new AuthUserRetriever())->retrieveUser();
		$role = Role::find($role_id);
		(new UpdateObjectValidator())->validate($role, 'role', $role_id);
		$role->name = Util::getQueryParameter($request->name);
		$role->updated_by_id = $user->id;
		$role->save();
		$this->processPermissionsForUpdate($request, $role);
		return redirect()->action('RoleController@getViewRole', ['role_Id' => $role->id])
			->with(['message' => 'Role updated']);
	}
	
	/**
	 * Load the page to view an role
	 *
	 * @param Request $request
	 * @param unknown $role_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewRole(Request $request, $role_id)
	{
		$role = Role::find($role_id);
		(new ViewObjectValidator())->validate($role, 'role', $role_id);
		$permissions = $role->permissions()->orderBy('name', 'asc')->get();
		return view('role.view-role', [
				'role' => $role,
				'permissions' => $permissions
		]);
	}
	
	/**
	 * Attach permissions to the new user
	 *
	 * @param Request $request
	 * @param unknown $new_user
	 */
	private function processPermissions(Request $request, $role, $old_permissions = null)
	{
		$new_permissions = array(); /* This is for auditing */
		$all_permissions = Permission::all();
		$request_permissions = $request->permissions;
		if ($request_permissions)
		{
			foreach ($all_permissions as $permission)
			{
				$all_permissions_name = Util::convertNameForForm($permission->name);
				foreach($request_permissions as $request_permission_name)
				{
					if ($request_permission_name === $all_permissions_name)
					{
						$role->permissions()->attach($permission);
						array_push($new_permissions, $permission);
						break;
					}
				}
			}
			/* Auditing */
			(new PermissionToRoleAuditor($request, Auth::user(), $role, $new_permissions, $old_permissions))->log();
		}
	}
	
	/**
	 * Attach permissions to the role for update
	 *
	 * @param Request $request
	 * @param unknown $new_user
	 */
	private function processPermissionsForUpdate(Request $request, $role)
	{
		/* Detach all existing permissions */
		$old_permissions = Util::copyArray($role->permissions); /* This is for auditing */
		$role->permissions()->detach();
		
		/* Add new permissions */
		$this->processPermissions($request, $role, $old_permissions);
	}
	
	/**
	 * Copy all permissions from another role to the current role 
	 * 
	 * @param Request $request
	 * @param unknown $role_id
	 */
	public function getCopyRolePermissions(Request $request, $role_id)
	{
		$role = Role::find($role_id);
		(new UpdateObjectValidator())->validate($role, 'role', $role_id);
		
		/* Extract a list of all roles, which permissions should be copied */
		$roles = (new RoleLookupRetriever())->execute();
		return view('role.copy-role-permissions', [ 
			'roles' => $roles,
			'role' => $role
		]);
	}
	
	/**
	 * Copy all permissions from another role to the current role
	 * 
	 * @param Request $request
	 * @param unknown $role_id
	 */
	public function postDoCopyRolePermissions(Request $request, $role_id)
	{
		$validator = Validator::make($request->all(), [
				'selected_role_id' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('copy-role-permissions', ['role_id' => $role_id])
				->withErrors($validator)
				->withInput();
		}
		$user = (new AuthUserRetriever())->retrieveUser();
		$role = Role::find($role_id);
		(new UpdateObjectValidator())->validate($role, 'role', $role_id);
		
		$selected_role_id = Util::getNumericQueryParameter($request->selected_role_id);
		$selected_role = Role::find($selected_role_id);
		(new UpdateObjectValidator())->validate($role, 'selected role', $selected_role_id);
		
		/* copy the roles here */
		$old_permissions = $role->permissions()->get();
		$new_permissions = $selected_role->permissions()->get();
		(new RolePermissionCopier($selected_role, $role))->copyRolePermissions();
		
		/* Auditing */
		(new PermissionToRoleAuditor($request, Auth::user(), $role, $new_permissions, $old_permissions))->log();
		
		return redirect()->action('RoleController@getViewRole', ['role_Id' => $role->id])
			->with(['message' => 'Permissions copied']);
	}
	
}
