<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\Role;
use jericho\Permission;
use jericho\Util\Util;
use jericho\Util\LookupUtil;

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
		return view('role.search-role');
	}
	
	/**
	 * Search for roles
	 *
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function postDoSearchRole(Request $request)
	{
		if (isset($request->name) && !is_null($request->name) && strlen($request->name) > 0)
		{
			$name = $request->name;
			$roles = Role::where('name', 'like', '%' . $name . '%')->orderBy('name', 'asc')->get();
		}
		else
		{
			$roles = Role::orderBy('name', 'asc')->get();
		}
		return view('role.search-role', ['roles' => $roles]);
	}
	
	/**
	 * Load page to add a role
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddRole()
	{
		$permissions = LookupUtil::retrievePermissionsForCheckboxes();
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
// 		$this->validate($request, [
// 				'name' => 'required|unique:roles'
// 		]);
		$validator = Validator::make($request->all(), [
				'name' => 'required|unique:roles'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('add-role')
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
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
		$permissions = LookupUtil::retrievePermissionsForCheckboxes($role->permissions);
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
// 		$this->validate($request, [
// 				'name' => 'required'
// 		]);
		$validator = Validator::make($request->all(), [
				'name' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('update-role', ['role_id' => $role_id])
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$role = Role::find($role_id);
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
		return view('role.view-role', [
				'role' => $role
		]);
	}
	
	/**
	 * Attach permissions to the new user
	 *
	 * @param Request $request
	 * @param unknown $new_user
	 */
	private function processPermissions(Request $request, $role)
	{
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
						break;
					}
				}
			}
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
		$role->permissions()->detach();
		/* Add new permissions */
		$this->processPermissions($request, $role);
	}
}
