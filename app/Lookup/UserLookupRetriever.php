<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\User;

/**
 * A component for retrieving users to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class UserLookupRetriever implements Component
{
	public function execute()
	{
		$table_users = User::all();
		$users = array();
		$users[-1] = "Select User";
		foreach($table_users as $user)
		{
			$users[$user->id] = $user->firstname . " " . $user->surname;
		}
		return $users;
	}
}