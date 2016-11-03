<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\SellerStatus;

/**
 * A component for retrieving seller status to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class SellerStatusLookupRetriever implements Component
{
	public function execute()
	{
		$table_seller_statuses = SellerStatus::all();
		$seller_statuses = array();
		$seller_statuses[-1] = "Select Seller Status";
		foreach($table_seller_statuses as $seller_status)
		{
			$seller_statuses[$seller_status->id] = $seller_status->description;
		}
		return $seller_statuses;
	}
}