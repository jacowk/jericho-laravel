<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\Permission;
use jericho\Role;
use jericho\Util\Util;
use jericho\Audits\RoleToPermissionAuditor;
use jericho\Lookup\RolesForCheckboxesRetriever;

/**
 * This class is a controller for performing CRUD operations on permissions
 *
 * @author Jaco Koekemoer
 * Date: 2016-09-29
 *
 */
class PermissionController extends Controller
{
	/**
	 * Load search page
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getSearchPermission()
	{
		return view('permission.search-permission', [
			'name' => null
		]);
	}
	
	/**
	 * Search for permissions
	 *
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function postDoSearchPermission(Request $request)
	{
		$user = Auth::user();
		$name = null;
		if (Util::isValidRequestVariable($request->name))
		{
			$name = $request->name;
			$permissions = Permission::where('name', 'like', '%' . $name . '%')->orderBy('name', 'asc')->paginate($user->pagination_size);
		}
		else
		{
			$permissions = Permission::orderBy('name', 'asc')->paginate($user->pagination_size);
		}
		return view('permission.search-permission', [
			'permissions' => $permissions,
			'name' => $name
		]);
	}
	
	/**
	 * Load page to add an permission
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddPermission()
	{
		$roles = (new RolesForCheckboxesRetriever())->execute();
		return view('permission.add-permission', [ 'roles' => $roles ]);
	}
	
	/**
	 * Add an permission
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddPermission(Request $request)
	{
		$validator = Validator::make($request->all(), [
				'name' => 'required|unique:permissions'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('add-permission')
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$permission = new Permission();
		$permission->name = Util::getQueryParameter($request->name);
		$permission->created_by_id = $user->id;
		$permission->save();
		$this->processRoles($request, $permission);
		return redirect()->action('PermissionController@getViewPermission', ['permission_Id' => $permission->id])
		->with(['message' => 'Permission saved']);
	}
	
	/**
	 * Load page to update an permission
	 *
	 * @param Request $request
	 * @param unknown $permission_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdatePermission(Request $request, $permission_id)
	{
		$permission = Permission::find($permission_id);
		$roles = (new RolesForCheckboxesRetriever($permission->roles))->execute();
		return view('permission.update-permission', ['permission' => $permission, 'roles' => $roles]);
	}
	
	/**
	 * Update an permission
	 *
	 * @param Request $request
	 * @param unknown $permission_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdatePermission(Request $request, $permission_id)
	{
		$validator = Validator::make($request->all(), [
				'name' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('update-permission', ['permission_id' => $permission_id])
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$permission = Permission::find($permission_id);
		$permission->name = Util::getQueryParameter($request->name);
		$permission->updated_by_id = $user->id;
		$permission->save();
		$this->processRolesForUpdate($request, $permission);
		return redirect()->action('PermissionController@getViewPermission', ['permission_Id' => $permission->id])
			->with(['message' => 'Permission updated']);
	}
	
	/**
	 * Load the page to view an permission
	 *
	 * @param Request $request
	 * @param unknown $permission_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewPermission(Request $request, $permission_id)
	{
		$permission = Permission::find($permission_id);
		return view('permission.view-permission', [
				'permission' => $permission
		]);
	}
	
	/**
	 * Attach roles to the new permission
	 *
	 * @param Request $request
	 * @param unknown $permission
	 */
	private function processRoles(Request $request, $permission, $old_roles = null)
	{
		$new_roles = array(); /* This is for auditing */
		$roles = Role::all();
		foreach ($roles as $role)
		{
			$role_name = Util::convertNameForForm($role->name);
			if ($request->$role_name)
			{
				$permission->roles()->attach($role);
				array_push($new_roles, $role);
			}
		}
		/* Auditing */
		(new RoleToPermissionAuditor($request, Auth::user(), $permission, $new_roles, $old_roles))->log();
	}
	
	/**
	 * Attach roles to the permission for update
	 *
	 * @param Request $request
	 * @param unknown $new_user
	 */
	private function processRolesForUpdate(Request $request, $permission)
	{
		/* Detach all existing roles */
		$old_roles = Util::copyArray($permission->roles); /* This is for auditing */
		$permission->roles()->detach();
	
		/* Add new roles */
		$this->processRoles($request, $permission, $old_roles);
	}
}
