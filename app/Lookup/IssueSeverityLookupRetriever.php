<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\LookupIssueSeverity;

/**
 * A component for retrieving issue severity list to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class IssueSeverityLookupRetriever implements Component
{
	public function execute()
	{
		$lookup_issue_severity_list = LookupIssueSeverity::all();
		$issue_severity_list = array();
		$issue_severity_list[-1] = "Select Issue Severity";
		foreach($lookup_issue_severity_list as $issue_severity)
		{
			$issue_severity_list[$issue_severity->id] = $issue_severity->description;
		}
		return $issue_severity_list;
	}
}