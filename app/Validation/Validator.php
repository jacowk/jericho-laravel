<?php
namespace jericho\Validation;

/**
 * This is an interface serving as a contract for validation
 * 
 * @author Jaco Koekemoer
 * Date: 2016-12-05
 *
 */
interface validator
{
	public function validate($object, $object_name, $object_id);
}