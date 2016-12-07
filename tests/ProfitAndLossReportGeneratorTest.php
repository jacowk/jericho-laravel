<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Reports\ProfitAndLossReportGenerator;
use jericho\User;

/**
 * A unit test class for testing ProfitAndLossReportGenerator methods
 *
 * @author Jaco Koekemoer
 * Date: 2016-12-06
 *
 */
class ProfitAndLossReportGeneratorTest extends TestCase
{
    public function testGenerate()
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
    	$data = (new ProfitAndLossReportGenerator($query_parameters, $user))->generate();
    	
    	$this->assertNotNull($data);
    }
}
