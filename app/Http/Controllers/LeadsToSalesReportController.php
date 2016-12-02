<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\Property;
use jericho\GreaterArea;
use jericho\Area;
use jericho\Suburb;
use jericho\Util\Util;
use jericho\Util\LookupUtil;
use jericho\Util\TabConstants;
use DB;

/**
 * A controller for generating a "Leads To Sales" report
 * 
 * @author Jaco Koekemoer
 * Date: 2016-11-01
 *
 */
class LeadsToSalesReportController extends Controller
{
	/**
	 * Load leads to sales
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getLeadsToSalesReport()
	{
		return view('reports.leads-to-sales', [
			'from_date' => null,
			'to_date' => null
		]);
	}
	
	/**
	 * Generate leads to sales report
	 *
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function postDoLeadsToSalesReport(Request $request)
	{
		$validator = Validator::make($request->all(), [
				'from_date' => 'required|date',
				'to_date' => 'required|date'
		]);
		
		if ($validator->fails()) {
			return redirect('leads-to-sales-report')
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
		
		$properties = DB::table('properties')
			->leftJoin('property_flips', 'properties.id', '=', 'property_flips.property_id')
			->leftJoin('suburbs', 'properties.suburb_id', '=', 'suburbs.id')
			->leftJoin('areas', 'properties.area_id', '=', 'areas.id')
			->leftJoin('greater_areas', 'properties.greater_area_id', '=', 'greater_areas.id')
			->whereBetween('property_flips.created_at', [$from_date_query_parameter, $to_date_query_parameter])
			->select('properties.*',
					'property_flips.reference_number as reference_number',
					'property_flips.id as property_flip_id',
					'property_flips.reference_number',
					'suburbs.name as suburb_name',
					'areas.name as area_name',
					'greater_areas.name as greater_area_name')
					->paginate($user->pagination_size);
		
		return view('reports.leads-to-sales', [
			'from_date' => $from_date,
			'to_date' => $to_date,
			'properties' => $properties
		]);
	}
}
