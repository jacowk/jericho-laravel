<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\LookupIssueCategory;

/**
 * A component for retrieving issue categories to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class IssueCategoryLookupRetriever implements Component
{
	public function execute()
	{
		$lookup_issue_categories = LookupIssueCategory::all();
		$issue_categories = array();
		$issue_categories[-1] = "Select Issue Category";
		foreach($lookup_issue_categories as $issue_category)
		{
			$issue_categories[$issue_category->id] = $issue_category->description;
		}
		return $issue_categories;
	}
}