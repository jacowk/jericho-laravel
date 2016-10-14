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
		$parameter = "test";
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
		$expected = "";
		$actual = Util::getQueryParameter($parameter);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Test getting query parameter with empty parameter
	 */
	public function testGetQueryParameterWithEmptyParameter()
	{
		$parameter = "";
		$expected = "";
		$actual = Util::getQueryParameter($parameter);
		$this->assertEquals($expected, $actual);
	}
}
