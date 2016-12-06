<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Reports\ProfitAndLossReportGenerator;

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
    	$date_from = null;
    	$date_to = null;
    	
    	/* From Date */
    	if (Util::isValidRequestVariable($request->from_date))
    	{
    		$from_date = $request->from_date;
    		$from_date_query_parameter = $from_date;
    		array_push($query_parameters, $from_date_query_parameter);
    	}
    	 
    	/* To Date */
    	if (Util::isValidRequestVariable($request->to_date))
    	{
    		$to_date = $request->to_date;
    		$to_date_query_parameter = $to_date;
    		array_push($query_parameters, $to_date_query_parameter);
    	}
    	
    	$data = (new ProfitAndLossReportGenerator($query_parameters))->execute();
    	
    }
}
