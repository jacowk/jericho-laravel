<?php
namespace jericho\Util;

use Illuminate\Http\Request;

/**
 * This class contains general methods for validating and transforming data 
 * 
 * @author Jaco Koekemoer
 *
 */
class Util
{
	/**
	 * Write to a file. This is mainly used for debugging during development.
	 *
	 * @param unknown $value
	 */
	public static function writeToFile($value)
	{
		$filename = "C:\laravel_output.txt";
		$file = fopen( $filename, "a" );
		 
		if( $file == false )
		{
			echo ( "Error in opening new file" );
			exit();
		}
		fwrite( $file, "$value\n" );
		fclose( $file );
	}
	
	/**
	 * Validate if a parameter is a valid string parameter
	 * 
	 * @param unknown $parameter
	 * @return unknown|string
	 */
	public static function getQueryParameter($parameter)
	{
		if (Util::isValidRequestVariable($parameter))
		{
			return $parameter;
		}
		return "";
	}
	
	/**
	 * Validate if a parameter is a valid numeric parameter
	 * 
	 * @param unknown $parameter
	 * @return unknown|number
	 */
	public static function getNumericQueryParameter($parameter)
	{
		if (Util::isValidRequestVariable($parameter) && is_numeric($parameter))
		{
			return $parameter;
		}
		return 0;
	}
	
	/**
	 * Validate if a parameter is a valid date parameter
	 * 
	 * @param unknown $parameter
	 * @return unknown|NULL
	 */
	public static function getDateQueryParameter($parameter)
	{
		if (Util::isValidRequestVariable($parameter) && strtotime($parameter))
		{
			return $parameter;
		}
		return null;
	}
	
	/**
	 * This method is used to ensure that if a value is selected via a combobox, that the value is not -1 
	 * for a non selection 
	 * 
	 * @param unknown $requestVar
	 * @return boolean
	 */
	public static function isValidSelectRequestVariable($requestVar)
	{
		if (Util::isValidRequestVariable($requestVar) && $requestVar > 0)
		{
			return true;
		}
		return false;
	}
	
	/**
	 * This method contains general validations for any type of variable
	 * 
	 * @param unknown $requestVar
	 * @return boolean
	 */
	public static function isValidRequestVariable($requestVar)
	{
		if (isset($requestVar) && !is_null($requestVar) && strlen($requestVar) > 0)
		{
			return true;
		}
		return false;
	}
	
	/**
	 * Remove a variable from the session
	 * 
	 * @param Request $request
	 * @param unknown $var_name
	 */
	public static function forgetSessionVariable(Request $request, $var_name)
	{
		if ($request->session->has($var_name))
		{
			$request->session->forget($var_name);
		}
	}
	
	/**
	 * Generate a filename for the storing of documents that are uploaded. The filename is similar to this:
	 * 20161017071456_12.pdf
	 * 
	 * @param unknown $user_id
	 * @param unknown $extension
	 * @return string
	 */
	public static function generateFilename($user_id, $extension)
	{
		if (!Util::isValidRequestVariable($user_id))
		{
			$user_id = rand(1, 100);
		}
		$filename = date('YmdHis') . "_" . $user_id;
		if (!Util::isValidRequestVariable($extension))
		{
			return $filename;
		}
		return $filename . "." . $extension;
	}
	
	/**
	 * Convert a name, such as Add Bank to add_bank, which are then used on forms as names
	 * 
	 * @param unknown $name
	 * @return mixed
	 */
	public static function convertNameForForm($name)
	{
		$name = strtolower($name);
		$name = str_replace(' ', '_', $name);
		return $name;
	}
	
	/**
	 * Process the currency values captured on screen. Currency values, due to masking, is submitted as
	 * R __ __2 000.00
	 * This means that the 'R' in front, all spaces, and dashes should be stripped. On top of this, 
	 * currency values are stored as cents in the database, so the value has to be multiplied by 100.
	 * 
	 * @param unknown $value
	 * @return number
	 */
	public static function processCurrencyValue($value)
	{
		$value = Util::getQueryParameter($value);
		if ($value || strlen($value) > 0)
		{
			$value = Util::stripCurrencyCharacters($value);
			$value = MoneyUtil::toCents((float) $value);
			return $value;
		}
		else
		{
			return 0;
		}
	}
	
	/**
	 * When a currency is captured on screen it is captured masked, and ends up in the request as
	 * 'R __100000.00'. The idea is to strip the currency mask characters
	 * @param unknown $value
	 */
	public static function stripCurrencyCharacters($value)
	{
		$value = str_replace('R', '', $value); /* Strip R */
		$value = str_replace(' ', '', $value); /* Strip white space in the middle */
		$value = str_replace('_', '', $value); /* Strip underscore */
		return $value;
	}
	
	/**
	 * Convert a parameter to a query parameter that can be used in the database for searches using like, so
	 * it has to be '%something%'
	 * 
	 * @param unknown $parameter
	 * @return string
	 */
	public static function convertToLikeQueryParameter($parameter)
	{
		return '%' . $parameter . '%';
	}
	
	/**
	 * Validate if a string contains another string
	 * 
	 * @param unknown $string
	 * @param unknown $contains
	 * @return boolean
	 */
	public static function stringContains($string, $contains)
	{
		if (strpos($string, $contains) !== false)
		{
			return true;
		}
		return false;
	}
	
	/**
	 * A method for copying an array
	 * 
	 * @param unknown $old_array
	 * $return array
	 */
	public static function copyArray($old_array)
	{
		$new_array = array();
		foreach($old_array as $item)
		{
			array_push($new_array, $item);
		}
		return $new_array;
	}
	
	/**
	 * Transform to getter method
	 * 
	 * @param unknown $value
	 * @return string
	 */
	public static function transformToGetterMethod($value)
	{
		$getter_name = str_replace('_', ' ', $value);
		$getter_name = strtolower($getter_name);
		$getter_name = ucwords($getter_name);
		$getter_name = str_replace(' ', '', $getter_name);
		$getter_name = 'get' . $getter_name;
		return $getter_name;
	}
}