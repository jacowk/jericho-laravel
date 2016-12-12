<?php
namespace jericho\Breadcrumbs;

use jericho\Component\Component;
use jericho\Breadcrumbs\BreadcrumbConstants;

/**
 * The purpose of this class is to build a single breadcrumb, which will be used as back links, as the user
 * navigates through the system. Breadcrumbs appears across the top of the web application, and identified by 
 * the bootstrap class "breadcrumb".
 * 
 * A breadcrumb will be built as an associative array with the following elements:
 * Item 1: route: The route as it appears in the route files
 * Item 2: parameters: Any parameters that are required for the link, for example, to go back to view a specific attorney
 * Item 3: link_description: The description of the link that the user will click view and click on.
 * 
 * @author Jaco Koekemoer
 * Date: 2016-12-12
 */
class BuildBreadcrumbItem implements Component
{
	public function __construct($route, $parameters, $link_description)
	{
		$this->route = $route;
		$this->parameters = $parameters;
		$this->link_description = $link_description;
	}
	
	public function execute()
	{
		$breadcrumb_item = array();
		$breadcrumb_item[BreadcrumbConstants::BREADCRUMB_ROUTE] = $this->route;
		$breadcrumb_item[BreadcrumbConstants::BREADCRUMB_PARAMETERS] = $this->parameters;
		$breadcrumb_item[BreadcrumbConstants::BREADCRUMB_LINK_DESCRIPTION] = $this->link_description;
		return $breadcrumb_item;
	}
}