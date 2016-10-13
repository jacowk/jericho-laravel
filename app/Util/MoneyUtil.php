<?php
namespace jericho\Util;

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
// 		return money_format('%.2n', $value); /* UNIX specific */
// 		$fmt = new NumberFormatter( 'en_ZA', NumberFormatter::CURRENCY ); 
// 		return $fmt->formatCurrency($value, 'R');

		$fmt = numfmt_create( 'en_ZA', NumberFormatter::CURRENCY ); 
		return numfmt_format($value, 'R');
	}
}