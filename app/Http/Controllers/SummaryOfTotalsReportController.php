<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;

use jericho\Http\Requests;

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
				'to_date' => null
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
		$total_properties = Properties::whereBetween('created_at', [$from_date_query_parameter, $to_date_query_parameter])->count();
		
		/* Calculate totals per seller status */
		$totals_per_seller_status = DB::table('property_flips')
										->join('seller_statuses', 'property_flips.seller_status_id', 'seller_statuses.id')
										->whereBetween('created_at', [$from_date_query_parameter, $to_date_query_parameter])
										->select('seller_statuses.description as seller_status', DB::raw('count(*) as cnt'))
										->groupBy('property_flips.seller_status_id')
										->get();
		
		/* Calculate totals per area */
		$totals_per_are
		
		/* Calculate totals per greater area */
	}
}
