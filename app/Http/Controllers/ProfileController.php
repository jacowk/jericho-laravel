<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use jericho\Http\Requests;
use jericho\User;
use jericho\Util\Util;
use DB;

/**
 * This class is a controller for performing CRUD operations on a user profile. A user profile is really a
 * user's own information, and is almost a duplication of UserController functionality and views. It's
 * the information for the user that is currently logged in.
 *
 * @author Jaco Koekemoer
 * Date: 2016-10-10
 *
 */
class ProfileController extends Controller
{
	/**
	 * Load the page to view a profile
	 *
	 * @param Request $request
	 * @param unknown $user_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewProfile(Request $request)
	{
		$user = Auth::user();
		return view('profile.view-profile', [
				'user' => $user
		]);
	}
	
	/**
	 * Load page to update an user
	 *
	 * @param Request $request
	 * @param unknown $user_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdateProfile(Request $request, $user_id)
	{
		$user = User::find($user_id);
		$pagination_size_options = (new PaginationSizeLookupRetriever())->execute();
		return view('profile.update-profile', [
				'user' => $user, 
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
	public function postDoUpdateProfile(Request $request, $user_id)
	{
		$validator = Validator::make($request->all(), [
				'firstname' => 'required',
				'surname' => 'required',
				'email' => 'required|email|unique:users,email,' . $user_id,
				'results_per_page' => 'required|numeric'
		]);
	
		if ($validator->fails()) {
			return redirect()
				->route('update-profile', ['user_id' => $user_id])
				->withErrors($validator)
				->withInput();
		}
		
		$user = Auth::user();
		$update_user = User::find($user_id);
		$update_user->firstname = Util::getQueryParameter($request->firstname);
		$update_user->surname = Util::getQueryParameter($request->surname);
		$update_user->email = Util::getQueryParameter($request->email);
		$update_user->pagination_size = Util::getQueryParameter($request->results_per_page);
		$update_user->updated_by_id = $user->id;
		$update_user->save();
		return redirect()->action('ProfileController@getViewProfile')
			->with(['message' => 'User Account updated']);
	}
}
