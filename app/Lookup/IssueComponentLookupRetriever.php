<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\LookupIssueComponent;

/**
 * A component for retrieving issue components to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class IssueComponentLookupRetriever implements Component
{
	public function execute()
	{
		$lookup_issue_components = LookupIssueComponent::orderBy('description', 'asc')->get();
		$issue_components = array();
		$issue_components[-1] = "Select Issue Component";
		foreach($lookup_issue_components as $issue_component)
		{
			$issue_components[$issue_component->id] = $issue_component->description;
		}
		return $issue_components;
	}
}