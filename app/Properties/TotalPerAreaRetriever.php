<?php
namespace jericho\Properties;

use jericho\Component\Component;
use DB;

/**
 * This component is used to retrieve the total number of properties per area
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-02
 *
 */
class TotalPerAreaRetriever implements Component
{
	public function __construct($from_date, $to_date)
	{
		$this->from_date = $from_date;
		$this->to_date = $to_date;
	}

	public function execute()
	{
		$totals_per_area = DB::table('properties')
								->leftJoin('areas', 'properties.area_id', '=', 'areas.id')
								->whereBetween('properties.created_at', [$this->from_date, $this->to_date])
								->select('areas.name as area_name', DB::raw('count(*) as cnt'))
								->groupBy('properties.area_id')
								->get();
		return $totals_per_area;
	}
}