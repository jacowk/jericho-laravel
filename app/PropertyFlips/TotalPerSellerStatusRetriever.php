<?php
namespace jericho\PropertyFlips;

use jericho\Component\Component;
use DB;

/**
 * This component is used to retrieve the total number of property flips per seller status
 * 
 * @author Jaco Koekemoer
 * Date: 2016-11-02
 *
 */
class TotalPerSellerStatusRetriever implements Component
{
	public function __construct($from_date, $to_date)
	{
		$this->from_date = $from_date;
		$this->to_date = $to_date;
	}
	
	public function execute()
	{
		$totals_per_seller_status = DB::table('property_flips')
										->leftJoin('seller_statuses', 'property_flips.seller_status_id', 'seller_statuses.id')
										->whereBetween('property_flips.created_at', [$this->from_date, $this->to_date])
										->select('seller_statuses.description as seller_status', DB::raw('count(*) as cnt'))
										->groupBy('property_flips.seller_status_id')
										->get();
		return $totals_per_seller_status;
	}
}