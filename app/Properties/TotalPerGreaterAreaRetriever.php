<?php
namespace jericho\Properties;

use jericho\Component\Component;
use DB;

/**
 * This component is used to retrieve the total number of properties per greater area
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-02
 *
 */
class TotalPerGreaterAreaRetriever implements Component
{
	public function __construct($from_date, $to_date)
	{
		$this->from_date = $from_date;
		$this->to_date = $to_date;
	}

	public function execute()
	{
		$totals_per_greater_area = DB::table('properties')
									->leftJoin('greater_areas', 'properties.greater_area_id', '=', 'greater_areas.id')
									->whereBetween('properties.created_at', [$this->from_date, $this->to_date])
									->select('greater_areas.name as greater_area_name', DB::raw('count(*) as cnt'))
									->groupBy('properties.greater_area_id')
									->get();
		return $totals_per_greater_area;
	}
}