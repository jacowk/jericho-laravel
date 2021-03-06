<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

use jericho\Http\Requests;
use jericho\User;
use jericho\Util\Util;
use jericho\Role;
use DB;
use jericho\Audits\RoleToUserAuditor;
use jericho\Lookup\RolesForCheckboxesRetriever;
use jericho\Lookup\PaginationSizeLookupRetriever;
use jericho\Http\Controllers\Auth\AuthUserRetriever;
use jericho\Validation\UpdateObjectValidator;
use jericho\Validation\ViewObjectValidator;

/**
 * This class is a controller for performing CRUD operations on users
 *
 * @author Jaco Koekemoer
 * Date: 2016-09-29
 *
 */
class UserController extends Controller
{
	/**
	 * Load search page
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getSearchUser()
	{
		return view('user.search-user', [
				'firstname' => null,
				'surname' => null
		]);
	}
	
	/**
	 * Search for users
	 *
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function postDoSearchUser(Request $request)
	{
		$user = (new AuthUserRetriever())->retrieveUser();
		$firstname = Util::getQueryParameter($request->firstname);
		$surname = Util::getQueryParameter($request->surname);
		$users = User::where([
	    					['firstname', 'like', '%' . $firstname . '%'],
	    					['surname', 'like', '%' . $surname . '%']
	    				])
						->orderBy('firstname', 'asc')
						->orderBy('surname', 'asc')
						->paginate($user->pagination_size);
		return view('user.search-user', [
				'users' => $users,
				'firstname' => $firstname,
				'surname' => $surname
		]);
	}
	
	/**
	 * Load page to add an user
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddUser()
	{
		$roles = (new RolesForCheckboxesRetriever())->execute();
		$pagination_size_options = (new PaginationSizeLookupRetriever())->execute();
		return view('user.add-user', [ 
				'roles' => $roles, 
				'pagination_size_options' => $pagination_size_options
		]);
	}
	
	/**
	 * Add an user
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddUser(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'firstname' => 'required',
			'surname' => 'required',
			'email' => 'required|email|unique:users',
			'password' => 'required|min:8|confirmed|case_diff|numbers|letters|symbols'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('add-user')
				->withErrors($validator)
				->withInput(Input::except('password'));
		}
		$user = (new AuthUserRetriever())->retrieveUser();
		$new_user = new User();
		$new_user->firstname = Util::getQueryParameter($request->firstname);
		$new_user->surname = Util::getQueryParameter($request->surname);
		$new_user->email = Util::getQueryParameter($request->email);
		$new_user->password = bcrypt(Util::getQueryParameter($request->password));
		$new_user->pagination_size = Util::getNumericQueryParameter($request->pagination_size);
		$new_user->created_by_id = $user->id;
		$new_user->save();
		$this->processRoles($request, $new_user);
		return redirect()->action('UserController@getViewUser', ['user_Id' => $new_user->id])
		->with(['message' => 'User saved']);
	}
	
	/**
	 * Load page to update an user
	 *
	 * @param Request $request
	 * @param unknown $user_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdateUser(Request $request, $user_id)
	{
		$user = User::find($user_id);
		(new UpdateObjectValidator())->validate($user, 'user', $user_id);
		$roles = (new RolesForCheckboxesRetriever($user->roles))->execute();
		$pagination_size_options = (new PaginationSizeLookupRetriever())->execute();
		
		return view('user.update-user', [
				'user' => $user, 
				'roles' => $roles,
				'pagination_size_options' => $pagination_size_options
		]);
	}
	
	/**
	 * Update an user
	 *
	 * @param Request $request
	 * @param unknown $user_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdateUser(Request $request, $user_id)
	{
		$validator = Validator::make($request->all(), [
			'firstname' => 'required',
			'surname' => 'required',
			'email' => 'required|email|unique:users,email,' . $user_id
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('update-user', ['user_id' => $user_id])
				->withErrors($validator)
				->withInput(Input::except('password'));
		}
		
		$user = (new AuthUserRetriever())->retrieveUser();
		$update_user = User::find($user_id);
		(new UpdateObjectValidator())->validate($update_user, 'user', $user_id);
		$update_user->firstname = Util::getQueryParameter($request->firstname);
		$update_user->surname = Util::getQueryParameter($request->surname);
		$update_user->email = Util::getQueryParameter($request->email);
		$update_user->pagination_size = Util::getNumericQueryParameter($request->pagination_size);
		$update_user->updated_by_id = $user->id;
		$update_user->save();
		$this->processRolesForUpdate($request, $update_user);
		return redirect()->action('UserController@getViewUser', ['user_Id' => $update_user->id])
			->with(['message' => 'User updated']);
	}
	
	/**
	 * Load the page to view an user
	 *
	 * @param Request $request
	 * @param unknown $user_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewUser(Request $request, $user_id)
	{
		$user = User::find($user_id);
		(new ViewObjectValidator())->validate($user, 'user', $user_id);
		return view('user.view-user', [
				'user' => $user
		]);
	}
	
	/**
	 * Load page to reset a password
	 *
	 * @param Request $request
	 * @param unknown $user_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function resetPassword(Request $request, $user_id)
	{
		$user = User::find($user_id);
		$roles = (new RolesForCheckboxesRetriever($user->roles))->execute();
		return view('user.reset-password', ['user' => $user]);
	}
	
	/**
	 * Reset a password
	 *
	 * @param Request $request
	 * @param unknown $user_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function doResetPassword(Request $request, $user_id)
	{
		$validator = Validator::make($request->all(), [
				'password' => 'required|min:6|confirmed'
		]);
	
		if ($validator->fails()) {
			return redirect()
				->route('reset-password', ['user_id' => $user_id])
				->withErrors($validator);
		}
	
		$user = (new AuthUserRetriever())->retrieveUser();
		$update_user = User::find($user_id);
		$update_user->password = bcrypt($request->password);
		$update_user->updated_by_id = $user->id;
		$update_user->save();
		return redirect()->action('UserController@getViewUser', ['user_Id' => $update_user->id])
			->with(['message' => 'Password reset']);
	}
	
	/**
	 * Attach roles to the new user
	 *
	 * @param Request $request
	 * @param unknown $new_user
	 */
	private function processRoles(Request $request, $user, $old_roles = null)
	{
		$new_roles = array(); /* This is for auditing */
		$roles = Role::all();
		foreach ($roles as $role)
		{
			$role_name = Util::convertNameForForm($role->name);
			if ($request->$role_name)
			{
				$user->roles()->attach($role);
				array_push($new_roles, $role);
			}
		}
		/* Auditing */
		(new RoleToUserAuditor($request, Auth::user(), $user, $new_roles, $old_roles))->log();
	}
	
	/**
	 * Attach roles to the new user for update
	 *
	 * @param Request $request
	 * @param unknown $new_user
	 */
	private function processRolesForUpdate(Request $request, $user)
	{
		/* Detach all existing roles */
		$old_roles = Util::copyArray($user->roles); /* This is for auditing */
		$user->roles()->detach();
	
		/* Add new roles */
		$this->processRoles($request, $user, $old_roles);
	}
}
