<?php
namespace jericho\Validation;

use jericho\Validation\Validator;
use Exception;

/**
 * This purpose of this class is to validate if an object is null or not empty
 *
 * @author Jaco Koekemoer
 * Date: 2016-12-05
 *
 */
class ViewObjectValidator implements Validator
{
	public function validate($object, $object_name, $object_id)
	{
		if (is_null($object))
		{
			throw new Exception("The " . $object_name . " is not available to view. ID: " . $object_id);
		}
	}
}