<?php
namespace jericho\Util;

/**
 * A class for converting JSON data to string
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-12 
 *
 */
class JSONUtil
{
	/**
	 * Convert JSON to HTML string
	 * @param unknown $jsonValue
	 * @return string
	 */
	public static function convertJSONToString($jsonValue)
	{
		$output = '';
		if (Util::isValidRequestVariable($jsonValue) && JSONUtil::isJson($jsonValue))
		{
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
				if ($key === 'file') /* The file property in the Document model should not be auditible */
				{
					continue;
				}
				$key = str_replace('_', ' ', $key);
				$key = ucwords($key);
				if (is_string($value))
				{
					$output .= '<b>' . $key . '</b>: ' . $value . '<br/>';
				}
				else if (!is_null($value) && (Util::stringContains($key, 'Amount')  ||  Util::stringContains($key, 'Price'))) /* debit_amount or credit_amount */
				{
					$output .= '<b>' . $key . '</b>: ' . MoneyUtil::toRandsAndFormat($value) . '<br/>';
				}
				else if (!is_null($value)) /* Integer values like ids */
				{
					$output .= '<b>' . $key . '</b>: ' . (string) $value . '<br/>';
				}
				else if (is_null($value))
				{
					$output .= '<b>' . $key . '</b>: null<br/>';
				}
			}
		}
		return $output;
	}
	
	/**
	 * Test if a string is JSON format
	 * 
	 * @param unknown $string
	 * @return boolean
	 */
	public static function isJson($string)
	{
	    return ((is_string($string) &&
				(is_object(json_decode($string)) ||
				is_array(json_decode($string))))) ? true : false;
	}
}