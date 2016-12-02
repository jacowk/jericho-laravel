<?php
namespace jericho\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Exception;

/**
 * This class is used for retrieving the currently authorised user, and throwing an exception 
 * if the user cannot be found
 *
 * @author Jaco Koekemoer
 * Date: 2016-12-02
 *
 */
class AuthUserRetriever
{
	public function retrieveUser()
	{
		$user = Auth::user();
		if ($user == null)
		{
			throw new Exception("Currently logged in user not found");
		}
		return $user;
	}
}
