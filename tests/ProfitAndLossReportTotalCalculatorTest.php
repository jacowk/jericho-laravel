<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Reports\ProfitAndLossReportGenerator;
use jericho\Reports\ProfitAndLossReportTotalCalculator;
use jericho\User;

/**
 * This unit test is used to test ProfitAndLossReportTotalCalculator
 * 
 * @author Jaco Koekemoer
 * Date: 2016-12-07
 *
 */
class ProfitAndLossReportTotalCalculatorTest extends TestCase
{
    public function testCalculate()
    {
    	$from_date_query_parameter = null;
    	$to_date_query_parameter = null;
    	$query_parameters = array();
    	
    	/* Prepare query parameters */
    	//     	$from_date = date_create_from_format('Y-m-d H:i:s', '2016-12-01 00:00:00');
    	//     	$to_date = date_create_from_format('Y-m-d H:i:s', '2016-12-20 23:59:59');
    	
    	$from_date = '2016-12-01 00:00:00';
    	$to_date = '2016-12-20 23:59:59';
    	 
    	/* From Date */
    	$from_date_query_parameter = ['property_flips.created_at', '>=',  $from_date];
    	array_push($query_parameters, $from_date_query_parameter);
    	 
    	/* To Date */
    	$to_date_query_parameter = ['property_flips.created_at', '<=', $to_date];
    	array_push($query_parameters, $to_date_query_parameter);
    	 
    	/* Find the user */
    	$user = User::find(1);
    	 
    	/* Generate the report data */
    	$report_data = (new ProfitAndLossReportGenerator($query_parameters, $user))->generate();
    	 
    	$total = (new ProfitAndLossReportTotalCalculator($report_data))->calculate();
    	$this->assertNotNull($total);
    	$this->assertTrue($total > 0);
    }
}
