<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Util\Util;

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
}
