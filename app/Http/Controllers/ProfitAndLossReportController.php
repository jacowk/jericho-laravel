<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\Reports\ProfitAndLossReportGenerator;
use jericho\Reports\ProfitAndLossReportTotalCalculator;
use jericho\Util\Util;
use jericho\Http\Controllers\Auth\AuthUserRetriever;
use PDF;

/**
 * A controller for generating an "Profit And Loss" report
 *
 * @author Jaco Koekemoer
 * Date: 2016-12-06
 *
 */
class ProfitAndLossReportController extends Controller
{
    public function getProfitAndLossReport()
    {
    	return view('reports.profit-and-loss', [
    			'from_date' => null,
    			'to_date' => null,
    			'report_data' => null,
    			'generated' => false
    	]);
    }
    
    public function postDoProfitAndLossReport(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    			'from_date' => 'required|date',
    			'to_date' => 'required|date'
    	]);
    	
    	if ($validator->fails()) {
    		return redirect('summary-of-totals-report')
    		->withErrors($validator)
    		->withInput();
    	}
    	
    	$user = (new AuthUserRetriever())->retrieveUser();
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
    		$from_date_query_parameter = ['property_flips.created_at', '>=',  $from_date];
    		array_push($query_parameters, $from_date_query_parameter);
    	}
    	
    	/* To Date */
    	if (Util::isValidRequestVariable($request->to_date))
    	{
    		$to_date = $request->to_date;
    		$to_date_query_parameter = ['property_flips.created_at', '<=', $to_date];
    		array_push($query_parameters, $to_date_query_parameter);
    	}
    	
    	/* Generate report data */
    	$report_data = (new ProfitAndLossReportGenerator($query_parameters))->generate();
    	if ($report_data == null)
    	{
    		throw new Exception("Report could not be generated");
    	}
    	$report_total = (new ProfitAndLossReportTotalCalculator($report_data))->calculate();
    	
    	return view('reports.profit-and-loss', [
    			'from_date' => $from_date,
    			'to_date' => $to_date,
    			'report_data' => $report_data,
    			'report_total' => $report_total,
    			'generated' => true
    	]);
    }
    
    /**
     * Download the pdf for this report
     *
     * @param Request $request
     */
    public function downloadPDF(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    			'from_date' => 'required|date',
    			'to_date' => 'required|date'
    	]);
    
    	if ($validator->fails()) {
    		return redirect('profit-and-loss')
	    		->withErrors($validator)
	    		->withInput();
    	}
    	
    	$user = (new AuthUserRetriever())->retrieveUser();
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
    		$from_date_query_parameter = ['property_flips.created_at', '>=',  $from_date];
    		array_push($query_parameters, $from_date_query_parameter);
    	}
    	 
    	/* To Date */
    	if (Util::isValidRequestVariable($request->to_date))
    	{
    		$to_date = $request->to_date;
    		$to_date_query_parameter = ['property_flips.created_at', '<=', $to_date];
    		array_push($query_parameters, $to_date_query_parameter);
    	}
    	 
    	/* Generate report data */
    	$report_data = (new ProfitAndLossReportGenerator($query_parameters))->generate();
    	if ($report_data == null)
    	{
    		throw new Exception("PDF could not be generated");
    	}
    	$report_total = (new ProfitAndLossReportTotalCalculator($report_data))->calculate();
    
    	/* Download PDF */
    	$pdf = PDF::loadView('pdf.profit-and-loss', [
    			'from_date' => $from_date,
    			'to_date' => $to_date,
    			'report_data' => $report_data,
    			'report_total' => $report_total
    	]);
    	return $pdf->download('profit-and-loss.pdf');
    }
}
