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
use jericho\Lookup\AreaLookupRetriever;
use jericho\Lookup\GreaterAreaLookupRetriever;
use DB;

/**
 * A controller for generating an "Leads Per Area" report
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-01
 *
 */
class LeadsPerAreaReportController extends Controller
{
	/**
	 * Load leads per area report
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getLeadsPerAreaReport()
	{
		$areas = (new AreaLookupRetriever())->execute();
		$greater_areas = (new GreaterAreaLookupRetriever())->execute();
		return view('reports.leads-per-area', [
				'area_id' => null,
				'greater_area_id' => null,
				'from_date' => null,
				'to_date' => null,
				'areas' => $areas,
				'greater_areas' => $greater_areas
		]);
	}
	
	/**
	 * Generate leads per area report
	 *
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function postDoLeadsPerAreaReport(Request $request)
	{
		$validator = Validator::make($request->all(), [
				'from_date' => 'required|date',
				'to_date' => 'required|date'
		]);
	
		if ($validator->fails()) {
			return redirect('leads-per-area-report')
			->withErrors($validator)
			->withInput();
		}
	
		$user = Auth::user();
		$query_parameters = array();
		$from_date_query_parameter = null;
		$to_date_query_parameter = null;
		$area_id_query_parameter = null;
		$greater_area_id_query_parameter = null;
	
		/* Prepare query parameters */
		$date_from = null;
		$date_to = null;
		$area_id = null;
		$greater_area_id = null;
	
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
		
		/* Area */
		if (Util::isValidSelectRequestVariable($request->area_id) && $request->area_id > 0)
		{
			$area_id = $request->area_id;
			$area_id_query_parameter = ['properties.area_id', '=', $area_id];
			array_push($query_parameters, $area_id_query_parameter);
		}
		
		/* Greater Area */
		if (Util::isValidSelectRequestVariable($request->greater_area_id) && $request->greater_area_id > 0)
		{
			$greater_area_id = $request->greater_area_id;
			$greater_area_id_query_parameter = ['properties.greater_area_id', '=', $greater_area_id];
			array_push($query_parameters, $greater_area_id_query_parameter);
		}
	
		$properties = DB::table('properties')
						->join('property_flips', 'properties.id', '=', 'property_flips.property_id')
						->join('suburbs', 'properties.suburb_id', '=', 'suburbs.id')
						->join('areas', 'properties.area_id', '=', 'areas.id')
						->join('greater_areas', 'properties.greater_area_id', '=', 'greater_areas.id')
						->whereBetween('property_flips.created_at', [$from_date_query_parameter, $to_date_query_parameter])
						->where($query_parameters)
						->select('properties.*',
								'property_flips.reference_number as reference_number',
								'property_flips.id as property_flip_id',
								'property_flips.reference_number',
								'suburbs.name as suburb_name',
								'areas.name as area_name',
								'greater_areas.name as greater_area_name')
								->paginate($user->pagination_size);
		$areas = (new AreaLookupRetriever())->execute();
		$greater_areas = (new GreaterAreaLookupRetriever())->execute();
		return view('reports.leads-per-area', [
				'from_date' => $from_date,
				'to_date' => $to_date,
				'area_id' => $area_id,
				'greater_area_id' => $greater_area_id,
				'properties' => $properties,
				'areas' => $areas,
				'greater_areas' => $greater_areas
		]);
	}
}
