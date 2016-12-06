<?php
namespace jericho\PropertyFlips;

use jericho\Component\Component;
use DB;

/**
 * This component is used to retrieve the total number of property flips per property status
 *
 * @author Jaco Koekemoer
 * Date: 2016-12-06
 *
 */
class TotalPerPropertyStatusRetriever implements Component
{
	public function __construct($from_date, $to_date)
	{
		$this->from_date = $from_date;
		$this->to_date = $to_date;
	}

	public function execute()
	{
		$totals_per_property_status = DB::table('property_flips')
			->leftJoin('property_statuses', 'property_flips.property_status_id', 'property_statuses.id')
			->whereBetween('property_flips.created_at', [$this->from_date, $this->to_date])
			->select (DB::raw('if(property_statuses.description is null, "No status", property_statuses.description) as property_status'), DB::raw('count(*) as cnt'))
			->groupBy('property_flips.property_status_id')
			->get();
		return $totals_per_property_status;
	}
}