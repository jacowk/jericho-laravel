<?php
namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;

use jericho\Http\Requests;
use jericho\Property;
use jericho\Util\Util;
use jericho\PropertyFlips\TotalPerSellerStatusRetriever;
use jericho\Properties\TotalPerAreaRetriever;
use jericho\Properties\TotalPerGreaterAreaRetriever;
use jericho\Properties\TotalPropertiesRetriever;
use DB;
use PDF;

/**
 * Controller for generating the summary of totals report. The following totals is to be generated:
 * Total property flips
 * Totals per seller status
 * Totals per area
 * 
 * @author Jaco Koekemoer
 * Date: 2016-11-01
 *
 */
class SummaryOfTotalsReportController extends Controller
{
	/**
	 * Load summary of totals
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getSummaryOfTotalsReport()
	{
		return view('reports.summary-of-totals', [
				'from_date' => null,
				'to_date' => null,
				'total_properties' => null,
				'totals_per_seller_status' => null,
				'totals_per_area' => null,
				'totals_per_greater_area' => null,
				'generated' => false
		]);
	}
	
	/**
	 * Generate summary of totals report
	 *
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function postDoSummaryOfTotalsReport(Request $request)
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
		
		$user = Auth::user();
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
		
		/* Calculate grand total */
		$total_properties = (new TotalPropertiesRetriever($from_date_query_parameter, $to_date_query_parameter))->execute();
		
		/* Calculate totals per seller status */
		$totals_per_seller_status = (new TotalPerSellerStatusRetriever($from_date_query_parameter, $to_date_query_parameter))->execute();
		
		/* Calculate totals per area */
		$totals_per_area = (new TotalPerAreaRetriever($from_date_query_parameter, $to_date_query_parameter))->execute();
		
		/* Calculate totals per greater area */
		$totals_per_greater_area = (new TotalPerGreaterAreaRetriever($from_date_query_parameter, $to_date_query_parameter))->execute();
		
		return view('reports.summary-of-totals', [
				'from_date' => $from_date,
				'to_date' => $to_date,
				'total_properties' => $total_properties,
				'totals_per_seller_status' => $totals_per_seller_status,
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
			return redirect('summary-of-totals-report')
			->withErrors($validator)
			->withInput();
		}
		
		$user = Auth::user();
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
		
		/* Calculate grand total */
		$total_properties = (new TotalPropertiesRetriever($from_date_query_parameter, $to_date_query_parameter))->execute();
		
		/* Calculate totals per seller status */
		$totals_per_seller_status = (new TotalPerSellerStatusRetriever($from_date_query_parameter, $to_date_query_parameter))->execute();
		
		/* Calculate totals per area */
		$totals_per_area = (new TotalPerAreaRetriever($from_date_query_parameter, $to_date_query_parameter))->execute();
		
		/* Calculate totals per greater area */
		$totals_per_greater_area = (new TotalPerGreaterAreaRetriever($from_date_query_parameter, $to_date_query_parameter))->execute();
		
		/* Download PDF */
		$pdf = PDF::loadView('pdf.summary-of-totals', [
				'from_date' => $from_date,
				'to_date' => $to_date,
				'total_properties' => $total_properties,
				'totals_per_seller_status' => $totals_per_seller_status,
				'totals_per_area' => $totals_per_area,
				'totals_per_greater_area' => $totals_per_greater_area
		]);
		return $pdf->download('summary-of-totals.pdf');
	}
	
}
