<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\FinanceStatus;

/**
 * A component for retrieving finance status to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class FinanceStatusLookupRetriever implements Component
{
	public function execute()
	{
		$table_finance_statuses = FinanceStatus::all();
		$finance_statuses = array();
		$finance_statuses[-1] = "Select Finance Status";
		foreach($table_finance_statuses as $finance_status)
		{
			$finance_statuses[$finance_status->id] = $finance_status->description;
		}
		return $finance_statuses;
	}
}