<?php
namespace jericho\Breadcrumbs;

use Illuminate\Http\Request;
use jericho\Component\Component;
use jericho\Breadcrumbs\BreadcrumbConstants;

/**
 * The purpose of this class is to store a breadcrumb on the session. Breadcrumbs will be stored as an array on the 
 * session. If there is already an array on the session, then this array will be augmented, by adding a new breadcrumb 
 * to it. This breadcrumb is stored an an array of associative arrays, such as follows:
 * 
 * [
 * 		[
 * 			'route' => 'example-route-1',
 * 			'paramaters' => ['parameter_1' => 'test'; 'parameter_2' => 'test']
 * 			'link_description' => 'Example 1'
 * 		],
 * 		[
 * 			'route' => 'example-route-2',
 * 			'paramaters' => ['parameter_3' => 'test'; 'parameter_4' => 'test']
 * 			'link_description' => 'Example 2'
 * 		] 
 * ]
 * 
 * Breadcrumbs appears across the top of the web application, and identified by the bootstrap class "breadcrumb".
 *
 * @author Jaco Koekemoer
 * Date: 2016-12-12
 */
class StoreBreadcrumbItem implements Component
{
	public function __construct(Request $request, $breadcrumb_item)
	{
		$this->request = $request;
		$this->breadcrumb_item = $breadcrumb_item;
	}
	
	public function execute()
	{
		if ($this->request != null && $this->request->session() != null)
		{
			if ($this->request->session()->exists(BreadcrumbConstants::BREADCRUMB_SESSION_VAR))
			{
				$breadcrumb = $this->request->session()->get(BreadcrumbConstants::BREADCRUMB_SESSION_VAR);
			}
			else
			{
				$breadcrumb = array();
			}
			array_push($breadcrumb, $this->breadcrumb_item);
			$breadcrumb = $this->request->session()->set(BreadcrumbConstants::BREADCRUMB_SESSION_VAR, $breadcrumb);
		}
	}
}