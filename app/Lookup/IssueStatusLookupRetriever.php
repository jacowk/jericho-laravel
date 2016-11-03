<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\IssueStatus;

/**
 * A component for retrieving issue status to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class IssueStatusLookupRetriever implements Component
{
	public function execute()
	{
		$table_issue_statuses = IssueStatus::all();
		$issue_statuses = array();
		$issue_statuses[-1] = "Select Issue Status";
		foreach($table_issue_statuses as $issue_status)
		{
			$issue_statuses[$issue_status->id] = $issue_status->description;
		}
		return $issue_statuses;
	}
}