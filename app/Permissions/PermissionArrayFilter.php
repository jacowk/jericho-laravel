<?php
namespace jericho\Permissions;

use jericho\Component\Component;

/**
 * The purpose of this class is, given two arrays of Permissions, return the list of array items that are
 * in array1, but not in array2.
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-27
 *
 */
class PermissionArrayFilter implements Component
{
	public function __construct($array1, $array2)
	{
		$this->array1 = $array1;
		$this->array2 = $array2;
	}
	
	/**
	 * 
	 * @param unknown $array1 of Permissions
	 * @param unknown $array2 of Permissions
	 * @return filtered_array of Permissions
	 */
	public function execute()
	{
		$filtered_array = array();
		$present = false;
		if ($this->array1 != null)
		{
			foreach($this->array1 as $permission1)
			{
				if ($this->array2 != null)
				{
					foreach($this->array2 as $permission2)
					{
						if ($permission1->id === $permission2->id)
						{
							$present = true;
							break;
						}
					}
					if (!$present)
					{
						array_push($filtered_array, $permission1);
					}
					$present = false;
				}
				else
				{
					/* If array2 is empty, it means that non of array1 is in array2, and all items in array1
					 * should be returned */
					array_push($filtered_array, $permission1);
				}
			}
		}
		return $filtered_array;
	}
}