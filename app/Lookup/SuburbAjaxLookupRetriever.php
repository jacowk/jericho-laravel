<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\Suburb;

/**
 * A component for retrieving suburbs to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class SuburbAjaxLookupRetriever implements Component
{
	public function __construct($area_id)
	{
		$this->area_id = $area_id;
	}
	
	public function execute()
	{
		$lookup_suburbs_for_area = Suburb::where('area_id', '=', $this->area_id)
									->select('suburbs.id', 'suburbs.name')
									->get();
		$suburbs_for_area = array();
		foreach($lookup_suburbs_for_area as $suburb)
		{
			$suburbs_for_area[$suburb->id] = $suburb->name;
		}
		return $suburbs_for_area;
	}
}