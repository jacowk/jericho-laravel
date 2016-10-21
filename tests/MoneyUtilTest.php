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
    public function testFormat()
    {
    	$parameter = 10000.00;
    	$actual = MoneyUtil::format($parameter);
    }
}
