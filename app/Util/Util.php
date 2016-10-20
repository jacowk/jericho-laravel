<?php
namespace jericho\Util;

use Illuminate\Http\Request;

class Util
{
	public static function getQueryParameter($parameter)
	{
		if (Util::isValidRequestVariable($parameter))
		{
			return $parameter;
		}
		return "";
	}
	
	public static function getNumericQueryParameter($parameter)
	{
		if (Util::isValidRequestVariable($parameter))
		{
			return $parameter;
		}
		return 0;
	}
	
	public static function getDateQueryParameter($parameter)
	{
		if (Util::isValidRequestVariable($parameter))
		{
			return $parameter;
		}
		return null;
	}
	
	public static function isValidSelectRequestVariable($requestVar)
	{
		if (Util::isValidRequestVariable($requestVar) && $requestVar > 0)
		{
			return true;
		}
		return false;
	}
	
	public static function isValidRequestVariable($requestVar)
	{
		if (isset($requestVar) && !is_null($requestVar) && strlen($requestVar) > 0)
		{
			return true;
		}
		return false;
	}
	
	public static function forgetSessionVariable(Request $request, $var_name)
	{
		if ($request->session->has($var_name))
		{
			$request->session->forget($var_name);
		}
	}
	
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
	 * Convert a name, such as Add Bank to add_bank, which are then used on forms
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
	 * Process the currency values captured on screen.
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
		$value = trim($value, 'R'); /* Strip R */
		$value = trim($value); /* Strip white space */
		$value = trim($value, '_'); /* Strip underscore */
		return $value;
	}
	
	/**
	 * Convert a parameter to a query parameter that can be used in the database for searches
	 * 
	 * @param unknown $parameter
	 * @return string
	 */
	public static function convertToLikeQueryParameter($parameter)
	{
		return '%' . $parameter . '%';
	}
}