<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Util\JSONUtil;

/**
 * A unit test class for testing JSONUtil methods
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
    public function testConvertJSONToString()
    {
    	$jsonValue = '{"name":"Test Account","debit_amount":1000000}';
    	$actual = JSONUtil::convertJSONToString($jsonValue);
    	$this->assertNotEmpty($actual, "The JSON output may not be empty");
    	$this->assertNotNull($actual, "The JSON output may not be null");
    	echo $actual;
    }
    
//     public static function convertJSONToString($jsonValue)
}
