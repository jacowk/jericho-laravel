<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\LookupTitle;

/**
 * A component for retrieving titles to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-02
 *
 */
class TitleLookupRetriever implements Component
{
	public function execute()
	{
		$lookup_titles = LookupTitle::all();
		$titles = array();
		$titles[-1] = "Select Title";
		foreach($lookup_titles as $title)
		{
			$titles[$title->id] = $title->description;
		}
		return $titles;
	}
}