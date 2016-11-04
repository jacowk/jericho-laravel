<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Util\JSONUtil;

/**
 * A unit test class for testing JSONUtil methods
 * 
 * JSON Examples
 * {"lookup_property_type_id":"Flat ","updated_by_id":"Web Master "}
	{"assigned_to_id":"1","lookup_issue_component_id":"Account ","lookup_issue_category_id":"Error ","lookup_issue_severity_id":"Low ","issue_status_id":"New ","description":"Test","created_by_id":"Web Master "}
	"Linked estate agent contact to property flip (ID: 1):<br\/><b>Estate Agent Name:<\/b> Test Estate Agent 0 (ID: 1),<br\/><b>Contact:<\/b> John Doe (ID: 1),<br\/><b>Estate Agent Type:<\/b> Purchasing Estate Agent (ID: 2)"
	{"effective_date":"2016-11-04","milestone_type_id":"Date Of Purchaser Signature ","property_flip_id":1,"created_by_id":"Web Master "}
 *
 * @author Jaco Koekemoer
 * Date: 2016-10-25
 *
 */
class JSONUtilTest extends TestCase
{
	/**
	 * Test convertJSONToString
	 */
    public function testConvertJSONToStringWithAmountData()
    {
    	//{"effective_date":"2016-11-04","description":"Test","reference":"Test","account_id":"Profit and Loss Account ","transaction_type_id":"Purchase Price ","debit_amount":10000000,"credit_amount":0,"created_by_id":"Web Master ","property_flip_id":1}
    	$jsonValue = '{"lookup_property_type_id":"Flat ","debit_amount":10000}';
    	$expected = 'R100,00';
    	$actual = JSONUtil::convertJSONToString($jsonValue);
    	$this->assertContains($expected, $actual);
    }
    
	/**
	 * Test convertJSONToString
	 */
    public function testConvertJSONToStringWithPriceData()
    {
    	//{"effective_date":"2016-11-04","description":"Test","reference":"Test","account_id":"Profit and Loss Account ","transaction_type_id":"Purchase Price ","debit_amount":10000000,"credit_amount":0,"created_by_id":"Web Master ","property_flip_id":1}
    	$jsonValue = '{"lookup_property_type_id":"Flat ","price":10000}';
    	$expected = 'R100,00';
    	$actual = JSONUtil::convertJSONToString($jsonValue);
    	$this->assertContains($expected, $actual);
    }
    
	/**
	 * Test convertJSONToString
	 */
    public function testConvertJSONToStringWithIntegerData()
    {
    	//{"effective_date":"2016-11-04","description":"Test","reference":"Test","account_id":"Profit and Loss Account ","transaction_type_id":"Purchase Price ","debit_amount":10000000,"credit_amount":0,"created_by_id":"Web Master ","property_flip_id":1}
    	$jsonValue = '{"lookup_property_type_id":"Flat ","test_id":12}';
    	$expected = '12';
    	$actual = JSONUtil::convertJSONToString($jsonValue);
    	$this->assertContains($expected, $actual);
    }
    
	/**
	 * Test convertJSONToString
	 */
    public function testConvertJSONToStringWithValidData()
    {
    	$jsonValue = '{"lookup_property_type_id":"Flat ","updated_by_id":"Web Master "}';
    	$actual = JSONUtil::convertJSONToString($jsonValue);
    	$this->assertNotEmpty($actual, "The JSON output may not be empty");
    	$this->assertNotNull($actual, "The JSON output may not be null");
    	$this->assertContains('<b>', $actual);
    }
    
	/**
	 * Test convertJSONToString
	 */
    public function testConvertJSONToStringWithNonJSONStringData()
    {
    	$parameter = 'test non JSON';
    	$expected = '';
    	$actual = JSONUtil::convertJSONToString($parameter);
    	$this->assertEquals($expected, $actual);
    }
    
	/**
	 * Test convertJSONToString
	 */
    public function testConvertJSONToStringWithNonJSONNumericData()
    {
    	$parameter = 0;
    	$expected = '';
    	$actual = JSONUtil::convertJSONToString($parameter);
    	$this->assertEquals($expected, $actual);
    }
    
	/**
	 * Test convertJSONToString
	 */
    public function testConvertJSONToStringWithEmptyData()
    {
    	$parameter = '';
    	$expected = '';
    	$actual = JSONUtil::convertJSONToString($parameter);
    	$this->assertEquals($expected, $actual);
    }
    
	/**
	 * Test convertJSONToString
	 */
    public function testConvertJSONToStringWithNullData()
    {
    	$parameter = null;
    	$expected = '';
    	$actual = JSONUtil::convertJSONToString($parameter);
    	$this->assertEquals($expected, $actual);
    }
    
    /**
     * Test isJson() method
     */
    public function testIsJsonWithValidData()
    {
    	$parameter = '{"lookup_property_type_id":"Flat ","updated_by_id":"Web Master "}';
    	$expected = true;
    	$actual = JSONUtil::isJson($parameter);
    	$this->assertEquals($expected, $actual);
    }
    
    /**
     * Test isJson() method
     */
    public function testIsJsonWithNonJSONStringData()
    {
    	$parameter = 'test non JSON';
    	$expected = false;
    	$actual = JSONUtil::isJson($parameter);
    	$this->assertEquals($expected, $actual);
    }
    
    /**
     * Test isJson() method
     */
    public function testIsJsonWithNonJSONNumericData()
    {
    	$parameter = 1234;
    	$expected = false;
    	$actual = JSONUtil::isJson($parameter);
    	$this->assertEquals($expected, $actual);
    }
    
    /**
     * Test isJson() method
     */
    public function testIsJsonWithEmptyData()
    {
    	$parameter = '';
    	$expected = false;
    	$actual = JSONUtil::isJson($parameter);
    	$this->assertEquals($expected, $actual);
    }
    
    /**
     * Test isJson() method
     */
    public function testIsJsonWithNullData()
    {
    	$parameter = '';
    	$expected = false;
    	$actual = JSONUtil::isJson($parameter);
    	$this->assertEquals($expected, $actual);
    }
    
}
