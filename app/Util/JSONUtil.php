<?php
namespace jericho\Util;

/**
 * A class for converting JSON data
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-12 
 *
 */
class JSONUtil
{
	public static function convertJSONToString($jsonValue)
	{
		//{"name":"Test Account","created_by_id":1}
		$output = "";
		if (!is_array($jsonValue))
		{
			$value_array = json_decode($jsonValue);
		}
		else
		{
			$value_array = $jsonValue;
		}
		foreach ($value_array as $key => $value)
		{
			$key = str_replace('_', ' ', $key);
			$key = ucwords($key);
			$output .= '<b>' . $key . '</b>: ' . $value . '<br/>';
		}
		return $output;
	}
}