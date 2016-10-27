<?php
namespace jericho\Permissions;

/**
 * The purpose of this class is, given two arrays or Permissions, return the list of array items that are
 * in array1, but not in array2.
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-27
 *
 */
class ArrayFilter
{
	/**
	 * 
	 * @param unknown $array1 of Permissions
	 * @param unknown $array2 of Permissions
	 * @return filtered_array of Permissions
	 */
	public function filter($array1, $array2)
	{
		$filtered_array = array();
		$present = false;
		foreach($array1 as $permission1)
		{
			foreach($array2 as $permission2)
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
		return $filtered_array;
	}
}