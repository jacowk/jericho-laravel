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
	
	public static function getContactTypes()
	{
		$contact_types = array('Attorney', 'Contractor', 'Estate Agent');
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
	
	public static function generateFilename($user_id, $extension)
	{
		$filename = date('YmdHis') . "_" . $user_id;
		return $filename . "." . $extension;
	}
	
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
}