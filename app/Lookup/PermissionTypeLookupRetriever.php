<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\LookupPermissionType;

/**
 * A component for retrieving permission types to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-12-09
 *
 */
class PermissionTypeLookupRetriever implements Component
{
	public function execute()
	{
		$lookup_permission_types = LookupPermissionType::all();
		$permission_types = array();
		$permission_types[-1] = "Select Permission Type";
		foreach($lookup_permission_types as $permission_type)
		{
			$permission_types[$permission_type->id] = $permission_type->description;
		}
		return $permission_types;
	}
}