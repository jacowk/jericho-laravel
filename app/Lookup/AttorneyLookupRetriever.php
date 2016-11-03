<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\Attorney;

/**
 * A component for retrieving attorneys to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class AttorneyLookupRetriever implements Component
{
	public function execute()
	{
		$lookup_attorneys = Attorney::all();
		$attorneys = array();
		$attorneys[-1] = "Select Attorney";
		foreach($lookup_attorneys as $attorney)
		{
			$attorneys[$attorney->id] = $attorney->name;
		}
		return $attorneys;
	}
}