<?php
namespace jericho\Breadcrumbs;

/**
 * This class contains constants 
 * 
 * @author Jaco Koekemoer
 * Date: 2016-12-12
 *
 */
class BreadcrumbConstants
{
	/* The session variable that will be used to store and retrieve the breadcrumb data on the session */
	const BREADCRUMB_SESSION_VAR = 'breadcrumb';
	/* The constant for the route of a breadcrumb */
	const BREADCRUMB_ROUTE = 'route';
	/* The constant for parameters for a breadrcrumb */
	const BREADCRUMB_PARAMETERS = 'parameters';
	/* The constant for the link description of a breadcrumb */
	const BREADCRUMB_LINK_DESCRIPTION = 'link_description';
}