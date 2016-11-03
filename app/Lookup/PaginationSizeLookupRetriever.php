<?php
namespace jericho\Lookup;

use jericho\Component\Component;

/**
 * A component for preparing pagination sizes to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class PaginationSizeLookupRetriever implements Component
{
	public function execute()
	{
		$pagination_size_options = array();
		$pagination_size_options[10] = 10;
		$pagination_size_options[20] = 20;
		$pagination_size_options[30] = 30;
		$pagination_size_options[50] = 50;
		return $pagination_size_options;
	}
}