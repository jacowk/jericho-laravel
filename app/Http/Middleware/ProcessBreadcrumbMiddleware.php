<?php

namespace jericho\Http\Middleware;

use Closure;
use jericho\Breadcrumbs\ClearBreadcrumb;
use jericho\Breadcrumbs\BuildBreadcrumbItem;
use jericho\Breadcrumbs\StoreBreadcrumbItem;
use jericho\Util\Util;

/**
 * This middleware class is to process data for breadcrumbs. The parameters means the following:
 * $route: A string describing the route, for example "add-attorney"
 * $parameters: An associative array, containing the required route parameters for the breadcrumb item
 * $link_description: A string containing the description of the breadcrumb link that the user will click on
 * $clear_breadcrumb: A boolean value, indicating if the current breadcrumb, with all items, to be deleted
 * from the session.
 * 
 * @author Jaco Koekemoer
 * Date: 2016-12-12
 *
 */
class ProcessBreadcrumbMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $route, $parameter, $link_description, $clear_breadcrumb)
    {
    	/* Clear the current breadcrumb if required */
    	if ($clear_breadcrumb)
    	{
    		(new ClearBreadcrumb($request))->execute();
    	}
    	
    	/* Build a parameter array */
    	$parameter_array = array();
    	if ($parameter)
    	{
    		Util::writeToLog($parameter . ' ' . $request->route($parameter));
	    	$parameter_array[$parameter] = $request->route($parameter);
    	}
    	
    	/* Build the breadcrumb */
    	$breadcrumb_item = (new BuildBreadcrumbItem($route, $parameter_array, $link_description))->execute();
    	
    	/* Store the breadcrumb on the session */
    	(new StoreBreadcrumbItem($request, $breadcrumb_item))->execute();
    	
        return $next($request);
    }
}
