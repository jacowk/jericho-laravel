<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\Property;
use jericho\Util\Util;
use DB;

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
		$total_properties = Property::whereBetween('created_at', [$from_date_query_parameter, $to_date_query_parameter])->count();
		
		/* Calculate totals per seller status */
		$totals_per_seller_status = DB::table('property_flips')
										->join('seller_statuses', 'property_flips.seller_status_id', 'seller_statuses.id')
										->whereBetween('property_flips.created_at', [$from_date_query_parameter, $to_date_query_parameter])
										->select('seller_statuses.description as seller_status', DB::raw('count(*) as cnt'))
										->groupBy('property_flips.seller_status_id')
										->get();
		
		/* Calculate totals per area */
		$totals_per_area = DB::table('properties')
								->join('areas', 'properties.area_id', '=', 'areas.id')
								->whereBetween('properties.created_at', [$from_date_query_parameter, $to_date_query_parameter])
								->select('areas.name as area_name', DB::raw('count(*) as cnt'))
								->groupBy('properties.area_id')
								->get();
		
		/* Calculate totals per greater area */
		$totals_per_greater_area = DB::table('properties')
								->join('greater_areas', 'properties.greater_area_id', '=', 'greater_areas.id')
								->whereBetween('properties.created_at', [$from_date_query_parameter, $to_date_query_parameter])
								->select('greater_areas.name as greater_area_name', DB::raw('count(*) as cnt'))
								->groupBy('properties.greater_area_id')
								->get();
		
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
}
