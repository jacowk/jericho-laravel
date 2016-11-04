<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Util\MoneyUtil;

/**
 * A unit test class for testing MoneyUtil methods
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-17
 *
 */
class MoneyUtilTest extends TestCase
{
	/**
	 * Test toRands() method
	 */
	public function testToRandsAndFormatWithValidData()
	{
		$parameter = 10000;
    	$expected = 'R100,00';
    	$actual = MoneyUtil::toRandsAndFormat($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test toRands() method
	 */
	public function testToRandsAndFormatWithNullData()
	{
		$parameter = null;
    	$expected = 'R0,00';
    	$actual = MoneyUtil::toRandsAndFormat($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test toRands() method
	 */
	public function testToRandsAndFormatWithEmptyData()
	{
		$parameter = '';
    	$expected = 'R0,00';
    	$actual = MoneyUtil::toRandsAndFormat($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test toRands() method
	 */
	public function testToRandsAndFormatWithTextData()
	{
		$parameter = 'test';
    	$expected = 'R0,00';
    	$actual = MoneyUtil::toRandsAndFormat($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test toRands() method
	 */
	public function testToRandsAndFormatWithZeroData()
	{
		$parameter = 0;
    	$expected = 'R0,00';
    	$actual = MoneyUtil::toRandsAndFormat($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**************************************************************************************/
	
	/**
	 * Test toRands() method
	 */
	public function testToRandsWithValidData()
	{
		$parameter = 1000000;
    	$expected = 10000.00;
    	$actual = MoneyUtil::toRands($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test toRands() method
	 */
	public function testToRandsWithNullData()
	{
		$parameter = null;
    	$expected = 0.00;
    	$actual = MoneyUtil::toRands($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test toRands() method
	 */
	public function testToRandsWithEmptyData()
	{
		$parameter = '';
    	$expected = 0.00;
    	$actual = MoneyUtil::toRands($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test toRands() method
	 */
	public function testToRandsWithTextData()
	{
		$parameter = 'test';
    	$expected = 0.00;
    	$actual = MoneyUtil::toRands($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test toRands() method
	 */
	public function testToRandsWithZeroData()
	{
		$parameter = 0;
    	$expected = 0.00;
    	$actual = MoneyUtil::toRands($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test toCents() method
	 */
	public function testToCentsWithValidData()
	{
		$parameter = 10000.00;
		$expected = 1000000;
		$actual = MoneyUtil::toCents($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test toCents() method
	 */
	public function testToCentsWithNullData()
	{
		$parameter = null;
		$expected = 0.00;
		$actual = MoneyUtil::toCents($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test toCents() method
	 */
	public function testToCentsWithEmptyData()
	{
		$parameter = '';
		$expected = 0.00;
		$actual = MoneyUtil::toCents($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test toCents() method
	 */
	public function testToCentsWithTextData()
	{
		$parameter = 'test';
		$expected = 0.00;
		$actual = MoneyUtil::toCents($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test toCents() method
	 */
	public function testToCentsWithZeroData()
	{
		$parameter = 0;
		$expected = 0.00;
		$actual = MoneyUtil::toCents($parameter);
		$this->assertEquals($expected, $actual);
	}
	
// 	/**
// 	 * Test format method
// 	 */
//     public function testFormatWithValidData()
//     {
//     	$parameter = 10000.00;
//     	$expected = 'R10 000,00';
//     	$actual = MoneyUtil::format($parameter);
// 		$this->assertEquals($expected, $actual);
//     }
}
