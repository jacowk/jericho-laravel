<?php
namespace jericho\Util;

use NumberFormatter;

/**
 * A util for managing money values
 * 
 * @author Jaco Koekemoer
 *
 */
class MoneyUtil
{
	/**
	 * Convert a cent value to rands, and then format as money value.
	 * 
	 * @param unknown $value
	 * @return string
	 */
	public static function toRandsAndFormat($value)
	{
		if ($value)
		{
			return MoneyUtil::format(MoneyUtil::toRands($value));
		}
		else
		{
			return MoneyUtil::format((float) '0.00');
		}
	}
	
	/**
	 * Convert a cent value to rands
	 * 
	 * @param unknown $value
	 * @return number
	 */
	public static function toRands($value)
	{
		return $value / 100;
	}
	
	/**
	 * Convert a rand value to cents
	 * 
	 * @param unknown $value
	 * @return number
	 */
	public static function toCents($value)
	{
		return $value * 100;
	}
	
	/**
	 * Format a money value
	 * 
	 * @param unknown $value
	 * @return string
	 */
	public static function format($value)
	{
		setlocale(LC_MONETARY, 'en_ZA');
		/* UNIX specific */
// 		return money_format('%.2n', $value);

		/* Windows specific */
		$fmt = new NumberFormatter('en_ZA', NumberFormatter::CURRENCY); 
		return $fmt->format($value);
	}
}