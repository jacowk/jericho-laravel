<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use jericho\Http\Requests;

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
}
