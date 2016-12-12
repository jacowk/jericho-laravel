<?php
namespace jericho\Breadcrumbs;

use Illuminate\Http\Request;
use jericho\Component\Component;
use jericho\Breadcrumbs\BreadcrumbConstants;

/**
 * The purpose of this class is to clear a breadcrumb, with all it's items, from the session. Breadcrumbs are cleared the moment a menu item
 * is accessed, to take the user to another component, for example "Third Parties, Attorneys". As the use progresses
 * through a component, will the breadcrumb be built up. 
 *
 * @author Jaco Koekemoer
 * Date: 2016-12-12
 */
class ClearBreadcrumb implements Component
{
	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function execute()
	{
		if ($this->request != null && $this->request->session() != null)
		{
			if ($this->request->session()->exists(BreadcrumbConstants::BREADCRUMB_SESSION_VAR))
			{
				$this->request->session()->forget(BreadcrumbConstants::BREADCRUMB_SESSION_VAR);
			}
		}
	}
}