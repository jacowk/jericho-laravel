<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;

use jericho\Http\Requests;
use jericho\Reports\ProfitAndLossReportGenerator;

/**
 * A controller for generating an "Profit And Loss" report
 *
 * @author Jaco Koekemoer
 * Date: 2016-12-06
 *
 */
class ProfitAndLossReportController extends Controller
{
    public function getProfitAndLossByDateReport()
    {
    	return view('reports.profit-and-loss', [
    			'from_date' => null,
    			'to_date' => null,
    			'total_properties' => null,
    			'totals_per_seller_status' => null,
    			'totals_per_property_status' => null,
    			'totals_per_area' => null,
    			'totals_per_greater_area' => null,
    			'generated' => false
    	]);
    }
    
    public function postDoProfitAndLossByDateReport()
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
    	
    	return view('reports.profit-and-loss', [
    			'from_date' => $from_date,
    			'to_date' => $to_date,
    			'total_properties' => $total_properties,
    			'totals_per_seller_status' => $totals_per_seller_status,
    			'totals_per_property_status' => $totals_per_property_status,
    			'totals_per_area' => $totals_per_area,
    			'totals_per_greater_area' => $totals_per_greater_area,
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
    
    	/* Prepare query parameters */
    	$date_from = null;
    	$date_to = null;
    
    	/* From Date */
    	if (Util::isValidRequestVariable($request->from_date))
    	{
    		$from_date = $request->from_date;
    		$from_date_query_parameter = $from_date;
    	}
    
    	/* To Date */
    	if (Util::isValidRequestVariable($request->to_date))
    	{
    		$to_date = $request->to_date;
    		$to_date_query_parameter = $to_date;
    	}
    
    	//Do stuff here
    
    	/* Download PDF */
    	$pdf = PDF::loadView('pdf.profit-and-loss', [
    			'from_date' => $from_date,
    			'to_date' => $to_date,
    			'total_properties' => $total_properties,
    			'totals_per_seller_status' => $totals_per_seller_status,
    			'totals_per_property_status' => $totals_per_property_status,
    			'totals_per_area' => $totals_per_area,
    			'totals_per_greater_area' => $totals_per_greater_area
    	]);
    	return $pdf->download('profit-and-loss.pdf');
    }
}
