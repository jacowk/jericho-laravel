<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\Role;
use jericho\Permission;
use jericho\Permissions\PermissionTypeConstants;
use jericho\Permissions\PermissionTypeFilter;
use jericho\Permissions\ExcludedPermissionTypeFilter;
use jericho\Util\Util;
use jericho\Audits\PermissionToRoleAuditor;
use jericho\Lookup\PermissionsForListboxRetriever;
use jericho\Lookup\PermissionsByPermissionTypeForListboxRetriever;
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
 *
 * TODO:
 * Unit tests for the following classes:
 * ExcludedPermissionTypeFilter
 * PermissionTypeFilter
 * PermissionsByPermissionTypeForListboxRetriever
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
		$admin_permissions = (new PermissionsByPermissionTypeForListboxRetriever(PermissionTypeConstants::ADMIN_PERMISSIONS))->execute();
		$report_permissions = (new PermissionsByPermissionTypeForListboxRetriever(PermissionTypeConstants::REPORT_PERMISSIONS))->execute();
		$third_party_permissions = (new PermissionsByPermissionTypeForListboxRetriever(PermissionTypeConstants::THIRD_PARTY_PERMISSIONS))->execute();
		$lookup_permissions = (new PermissionsByPermissionTypeForListboxRetriever(PermissionTypeConstants::LOOKUP_PERMISSIONS))->execute();
		$property_permissions = (new PermissionsByPermissionTypeForListboxRetriever(PermissionTypeConstants::PROPERTY_PERMISSIONS))->execute();
		$global_permissions = (new PermissionsByPermissionTypeForListboxRetriever(PermissionTypeConstants::GLOBAL_PERMISSIONS))->execute();
		return view('role.add-role', [
			'admin_permissions' => $admin_permissions,
			'report_permissions' => $report_permissions,
			'third_party_permissions' => $third_party_permissions,
			'lookup_permissions' => $lookup_permissions,
			'property_permissions' => $property_permissions,
			'global_permissions' => $global_permissions
		]);
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
		$this->processPermissions($request, $this->consolidatePermissions($request), $role);
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
		
		/* Retrieve admin permissions */
		$admin_permissions = (new PermissionsByPermissionTypeForListboxRetriever(
				PermissionTypeConstants::ADMIN_PERMISSIONS,
				(new PermissionTypeFilter($role->permissions, PermissionTypeConstants::ADMIN_PERMISSIONS))->execute()
			))->execute();
		
		/* Retrieve report permissions */
		$report_permissions = (new PermissionsByPermissionTypeForListboxRetriever(
				PermissionTypeConstants::REPORT_PERMISSIONS,
				(new PermissionTypeFilter($role->permissions, PermissionTypeConstants::REPORT_PERMISSIONS))->execute()
			))->execute();
		
		/* Retrieve third party permissions */
		$third_party_permissions = (new PermissionsByPermissionTypeForListboxRetriever(
				PermissionTypeConstants::THIRD_PARTY_PERMISSIONS,
				(new PermissionTypeFilter($role->permissions, PermissionTypeConstants::THIRD_PARTY_PERMISSIONS))->execute()
			))->execute();
		
		/* Retrieve lookup permissions */
		$lookup_permissions = (new PermissionsByPermissionTypeForListboxRetriever(
				PermissionTypeConstants::LOOKUP_PERMISSIONS,
				(new PermissionTypeFilter($role->permissions, PermissionTypeConstants::LOOKUP_PERMISSIONS))->execute()
			))->execute();
		
		/* Retrieve property permissions */
		$property_permissions = (new PermissionsByPermissionTypeForListboxRetriever(
				PermissionTypeConstants::PROPERTY_PERMISSIONS,
				(new PermissionTypeFilter($role->permissions, PermissionTypeConstants::PROPERTY_PERMISSIONS))->execute()
			))->execute();
		
		/* Retrieve global permissions */
		$global_permissions = (new PermissionsByPermissionTypeForListboxRetriever(
				PermissionTypeConstants::GLOBAL_PERMISSIONS,
				(new PermissionTypeFilter($role->permissions, PermissionTypeConstants::GLOBAL_PERMISSIONS))->execute()
			))->execute();
		
		return view('role.update-role', [
			'role' => $role, 
			'admin_permissions' => $admin_permissions,
			'report_permissions' => $report_permissions,
			'third_party_permissions' => $third_party_permissions,
			'lookup_permissions' => $lookup_permissions,
			'property_permissions' => $property_permissions,
			'global_permissions' => $global_permissions
		]);
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
		$role_permissions = $role->permissions()->orderBy('name', 'asc')->get();
		$all_permissions = Permission::all();
		
		/* Retrieve admin permissions */
		$admin_permissions = (new PermissionTypeFilter($role_permissions, PermissionTypeConstants::ADMIN_PERMISSIONS))->execute();
		$excluded_admin_permissions = (new ExcludedPermissionTypeFilter(
				(new PermissionTypeFilter($all_permissions, PermissionTypeConstants::ADMIN_PERMISSIONS))->execute(),
				$admin_permissions, PermissionTypeConstants::ADMIN_PERMISSIONS))->execute();
		
		/* Retrieve report permissions */
		$report_permissions = (new PermissionTypeFilter($role_permissions, PermissionTypeConstants::REPORT_PERMISSIONS))->execute();
		$excluded_report_permissions = (new ExcludedPermissionTypeFilter(
				(new PermissionTypeFilter($all_permissions, PermissionTypeConstants::REPORT_PERMISSIONS))->execute(),
				$report_permissions, PermissionTypeConstants::REPORT_PERMISSIONS))->execute();

		/* Retrieve third party permissions */
		$third_party_permissions = (new PermissionTypeFilter($role_permissions, PermissionTypeConstants::THIRD_PARTY_PERMISSIONS))->execute();
		$excluded_third_party_permissions = (new ExcludedPermissionTypeFilter(
				(new PermissionTypeFilter($all_permissions, PermissionTypeConstants::THIRD_PARTY_PERMISSIONS))->execute(),
				$third_party_permissions, PermissionTypeConstants::THIRD_PARTY_PERMISSIONS))->execute();

		/* Retrieve lookup permissions */
		$lookup_permissions = (new PermissionTypeFilter($role_permissions, PermissionTypeConstants::LOOKUP_PERMISSIONS))->execute();
		$excluded_lookup_permissions = (new ExcludedPermissionTypeFilter(
				(new PermissionTypeFilter($all_permissions, PermissionTypeConstants::LOOKUP_PERMISSIONS))->execute(),
				$lookup_permissions, PermissionTypeConstants::LOOKUP_PERMISSIONS))->execute();

		/* Retrieve property permissions */
		$property_permissions = (new PermissionTypeFilter($role_permissions, PermissionTypeConstants::PROPERTY_PERMISSIONS))->execute();
		$excluded_property_permissions = (new ExcludedPermissionTypeFilter(
				(new PermissionTypeFilter($all_permissions, PermissionTypeConstants::PROPERTY_PERMISSIONS))->execute(),
				$property_permissions, PermissionTypeConstants::PROPERTY_PERMISSIONS))->execute();

		/* Retrieve global permissions */
		$global_permissions = (new PermissionTypeFilter($role_permissions, PermissionTypeConstants::GLOBAL_PERMISSIONS))->execute();
		$excluded_global_permissions = (new ExcludedPermissionTypeFilter(
				(new PermissionTypeFilter($all_permissions, PermissionTypeConstants::GLOBAL_PERMISSIONS))->execute(),
				$global_permissions, PermissionTypeConstants::GLOBAL_PERMISSIONS))->execute();
		
		return view('role.view-role', [
				'role' => $role,
				'admin_permissions' => $admin_permissions,
				'report_permissions' => $report_permissions,
				'third_party_permissions' => $third_party_permissions,
				'lookup_permissions' => $lookup_permissions,
				'property_permissions' => $property_permissions,
				'global_permissions' => $global_permissions,
				
				'excluded_admin_permissions' => $excluded_admin_permissions,
				'excluded_report_permissions' => $excluded_report_permissions,
				'excluded_third_party_permissions' => $excluded_third_party_permissions,
				'excluded_lookup_permissions' => $excluded_lookup_permissions,
				'excluded_property_permissions' => $excluded_property_permissions,
				'excluded_global_permissions' => $excluded_global_permissions
		]);
	}
	
	/**
	 * Take all permissions arrays from the UI and consolidate them for processing
	 * 
	 * @param Request $request
	 */
	private function consolidatePermissions(Request $request)
	{
		$consolidated_permissions = array();
		if ($request->admin_permissions) 
		{
			$consolidated_permissions = array_merge($consolidated_permissions, $request->admin_permissions);
		}
		if ($request->report_permissions)
		{
			$consolidated_permissions = array_merge($consolidated_permissions, $request->report_permissions);
		}
		if ($request->third_party_permissions)
		{
			$consolidated_permissions = array_merge($consolidated_permissions, $request->third_party_permissions);
		}
		if ($request->lookup_permissions)
		{
			$consolidated_permissions = array_merge($consolidated_permissions, $request->lookup_permissions);
		}
		if ($request->property_permissions)
		{
			$consolidated_permissions = array_merge($consolidated_permissions, $request->property_permissions);
		}
		if ($request->global_permissions)
		{
			$consolidated_permissions = array_merge($consolidated_permissions, $request->global_permissions);
		}
		return $consolidated_permissions;
	}
	
	/**
	 * Attach permissions to the new user
	 *
	 * @param Request $request
	 * @param unknown $new_user
	 */
	private function processPermissions($request, $request_permissions, $role, $old_permissions = null)
	{
		$new_permissions = array(); /* This is for auditing */
		$all_permissions = Permission::all();
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
		$this->processPermissions($request, $this->consolidatePermissions($request), $role, $old_permissions);
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
