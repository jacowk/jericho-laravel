<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Util\Util;

/**
 * A unit test class for testing Util methods
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-14
 *
 */
class UtilTest extends TestCase
{
	/**
	 * Test getting query parameter with valid parameter
	 */
	public function testGetQueryParameterWithValidParameter()
	{
		$parameter = 'test';
		$expected = $parameter;
		$actual = Util::getQueryParameter($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test getting query parameter with null parameter
	 */
	public function testGetQueryParameterWithNullParameter()
	{
		$parameter = null;
		$expected = '';
		$actual = Util::getQueryParameter($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test getting query parameter with empty parameter
	 */
	public function testGetQueryParameterWithEmptyParameter()
	{
		$parameter = '';
		$expected = '';
		$actual = Util::getQueryParameter($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test getting numeric parameter with valid parameter
	 */
	public function testGetNumericQueryParameterWithValidParameter()
	{
		$parameter = 12;
		$expected = 12;
		$actual = Util::getNumericQueryParameter($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test getting numeric parameter with float parameter
	 */
	public function testGetNumericQueryParameterWithFloatParameter()
	{
		$parameter = 1.2;
		$expected = 1.2;
		$actual = Util::getNumericQueryParameter($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test getting numeric parameter with null parameter
	 */
	public function testGetNumericQueryParameterWithNullParameter()
	{
		$parameter = null;
		$expected = 0;
		$actual = Util::getNumericQueryParameter($parameter);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * Test getting numeric parameter with string parameter
	 */
	public function testGetNumericQueryParameterWithStringParameter()
	{
		$parameter = 'test';
		$expected = 0;
		$actual = Util::getNumericQueryParameter($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test getting a date parameter with valid date string
	 */
	public function testGetDateQueryParameterWithValidDateString()
	{
		$parameter = '2015-11-03';
		$expected = '2015-11-03';
		$actual = Util::getDateQueryParameter($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test getting a date parameter with invalid date string
	 */
	public function testGetDateQueryParameterWithInvalidDateString()
	{
		$parameter = 'test';
		$expected = null;
		$actual = Util::getDateQueryParameter($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test for a valid select request variable with valid parameter, being any number above 0
	 */
	public function testIsValidSelectRequestVariableWithValidParameter()
	{
		$parameter = 1;
		$expected = true;
		$actual = Util::isValidSelectRequestVariable($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test for a valid select request variable with invalid parameter, being 0 or below
	 */
	public function testIsValidSelectRequestVariableWithInvalidParameter()
	{
		$parameter = 0;
		$expected = false;
		$actual = Util::isValidSelectRequestVariable($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test for a valid select request variable with invalid string parameter
	 */
	public function testIsValidSelectRequestVariableWithInvalidStringParameter()
	{
		$parameter = 'test';
		$expected = false;
		$actual = Util::isValidSelectRequestVariable($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test for a valid select request variable with invalid null parameter
	 */
	public function testIsValidSelectRequestVariableWithInvalidNullParameter()
	{
		$parameter = null;
		$expected = false;
		$actual = Util::isValidSelectRequestVariable($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test validation of a request variable with valid parameter
	 */
	public function testIsValidRequestVariableWithValidParameter()
	{
		$parameter = 'test';
		$expected = true;
		$actual = Util::isValidRequestVariable($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test validation of a request variable with null parameter
	 */
	public function testIsValidRequestVariableWithNullParameter()
	{
		$parameter = null;
		$expected = false;
		$actual = Util::isValidRequestVariable($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test validation of a request variable with empty parameter
	 */
	public function testIsValidRequestVariableWithEmptyParameter()
	{
		$parameter = '';
		$expected = false;
		$actual = Util::isValidRequestVariable($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test getting numeric parameter with valid parameter
	 */
	public function testGetNumericParameterWithValidParameter()
	{
		$parameter = 12;
		$expected = $parameter;
		$actual = Util::getNumericQueryParameter($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test getting numeric parameter with null parameter
	 */
	public function testGetNumericParameterWithNullParameter()
	{
		$parameter = null;
		$expected = 0;
		$actual = Util::getNumericQueryParameter($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test getting numeric parameter with empty parameter
	 */
	public function testGetNumericParameterWithEmptyParameter()
	{
		$parameter = '';
		$expected = 0;
		$actual = Util::getNumericQueryParameter($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test getting date parameter with valid parameter
	 */
	public function testGetDateParameterWithValidParameter()
	{
		$parameter = date('Y-m-d');
		$expected = $parameter;
		$actual = Util::getDateQueryParameter($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test getting date parameter with null parameter
	 */
	public function testGetDateParameterWithNullParameter()
	{
		$parameter = null;
		$expected = null;
		$actual = Util::getDateQueryParameter($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test getting date parameter with empty parameter
	 */
	public function testGetDateParameterWithEmptyParameter()
	{
		$parameter = '';
		$expected = null;
		$actual = Util::getDateQueryParameter($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test the generation of a filename with valid parameters
	 */
	public function testGenerateFilenameWithValidData()
	{
		$user_id = 12;
		$extension = 'pdf';
		$actual = Util::generateFilename($user_id, $extension);
		$this->assertNotNull($actual);
		$this->assertContains($extension, $actual);
		$this->assertContains('_' . $user_id, $actual);
	}
	
	/**
	 * Test the generation of a filename with null userid
	 */
	public function testGenerateFilenameWithNullUserId()
	{
		$user_id = null;
		$extension = 'pdf';
		$actual = Util::generateFilename($user_id, $extension);
		$this->assertNotNull($actual);
		$this->assertNotContains('null', $actual);
		$this->assertNotContains('_.' . $extension, $actual);
	}
	
	/**
	 * Test the generation of a filename with null userid
	 */
	public function testGenerateFilenameWithNullExtension()
	{
		$user_id = 15;
		$extension = null;
		$actual = Util::generateFilename($user_id, $extension);
		$this->assertNotNull($actual);
		$this->assertNotContains('null', $actual);
	}
	
	//Continue with convertNameForForm and figure out exception handling
	
	/**
	 * Test string contains with values
	 */
	public function testStringContainsWithValidAmountTest()
	{
		$string = 'debit_amount';
		$contains = 'amount';
		$actual = Util::stringContains($string, $contains);
		$this->assertTrue($actual);
	}
	
	/**
	 * Test string with invalid values
	 */
	public function testStringContainsWithValidPriceTest()
	{
		$string = 'debit_price';
		$contains = 'price';
		$actual = Util::stringContains($string, $contains);
		$this->assertTrue($actual);
	}
	
	/**
	 * Test string with invalid values
	 */
	public function testStringContainsWithInValidTest()
	{
		$string = 'debit_invalid';
		$contains = 'price';
		$actual = Util::stringContains($string, $contains);
		$this->assertFalse($actual);
	}
	
	/**
	 * Convert name for form with variation 1
	 */
	public function testConvertNameForFormWithVariation1()
	{
		$parameter = 'TEST TEST TEST';
		$expected = 'test_test_test';
		$actual = Util::convertNameForForm($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Convert name for form with variation 2
	 */
	public function testConvertNameForFormWithVariation2()
	{
		$parameter = 'TESTTESTTEST';
		$expected = 'testtesttest';
		$actual = Util::convertNameForForm($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Convert name for form with variation 3
	 */
	public function testConvertNameForFormWithVariation3()
	{
		$parameter = 'TEST1234TEST';
		$expected = 'test1234test';
		$actual = Util::convertNameForForm($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Convert name for form with variation 4
	 */
	public function testConvertNameForFormWithVariation4()
	{
		$parameter = 'TEST TEST$TEST';
		$expected = 'test_test$test';
		$actual = Util::convertNameForForm($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test the processing of a currency value with valid data
	 */
	public function testProcessCurrencyValueWithValidData()
	{
		$parameter = 'R __ __2 000.00';
		$expected = 200000;
		$actual = Util::processCurrencyValue($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test the processing of a currency value with null value
	 */
	public function testProcessCurrencyValueWithNullValue()
	{
		$parameter = null;
		$expected = 0;
		$actual = Util::processCurrencyValue($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test the processing of a currency value with empty value
	 */
	public function testProcessCurrencyValueWithEmptyValue()
	{
		$parameter = '';
		$expected = 0;
		$actual = Util::processCurrencyValue($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test the processing of a currency value with string value
	 */
	public function testProcessCurrencyValueWithStringValue()
	{
		$parameter = 'test';
		$expected = 0;
		$actual = Util::processCurrencyValue($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Strip currency characters with valid characters
	 */
	public function testStripCurrencyCharactersWithValidCharacters()
	{
		$parameter = 'R __100 000.00';
		$expected = '100000.00';
		$actual = Util::stripCurrencyCharacters($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Strip currency characters variation 1
	 */
	public function testStripCurrencyCharactersVariation1()
	{
		$parameter = 'R __100 000.00 ';
		$expected = '100000.00';
		$actual = Util::stripCurrencyCharacters($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Strip currency characters variation 2
	 */
	public function testStripCurrencyCharactersVariation2()
	{
		$parameter = '__100 000.00 ';
		$expected = '100000.00';
		$actual = Util::stripCurrencyCharacters($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Strip currency characters variation 3
	 */
	public function testStripCurrencyCharactersVariation3()
	{
		$parameter = ' _ _100_ 0 00.0_0 ';
		$expected = '100000.00';
		$actual = Util::stripCurrencyCharacters($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test conversion of a parameter to a like query parameter
	 */
	public function testConvertToLikeQueryParameterWithValidParameter()
	{
		
	}
}
