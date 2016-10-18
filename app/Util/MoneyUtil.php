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
	
	public static function toRands($value)
	{
		return $value / 100;
	}
	
	public static function toCents($value)
	{
		return $value * 100;
	}
	
	public static function format($value)
	{
		setlocale(LC_MONETARY, 'en_ZA');
		/* UNIX specific */
// 		return money_format('%.2n', $value);

		/* Windows specific */
		$fmt = new NumberFormatter( 'en_ZA', NumberFormatter::CURRENCY ); 
		return $fmt->format($value);
	}
}