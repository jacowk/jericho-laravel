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
 * This class is a controller for performing CRUD operations on propertys
 *
 * @author Jaco Koekemoer
 * Date: 2016-09-19
 *
 */
class PropertyController extends Controller
{
	/**
	 * Load search page
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getSearchProperty()
	{
		$suburbs = LookupUtil::retrieveSuburbsLookup();
		$areas = LookupUtil::retrieveAreasLookup();
		$greater_areas = LookupUtil::retrieveGreaterAreasLookup();
		return view('property.search-property', [
			'address' => null,
			'suburb_id' => null,
			'area_id' => null,
			'greater_area_id' => null,
			'reference_number' => null,
			'suburbs' => $suburbs,
			'areas' => $areas,
			'greater_areas' => $greater_areas
		]);
	}
	
	/**
	 * Search for propertys
	 *
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function postDoSearchProperty(Request $request)
	{
		$user = Auth::user();
		$address = null;
		$query_parameters = array();
		
		/* Prepare query parameters */
		$address = null;
		$suburb_id = null;
		$area_id = null;
		$greater_area_id = null;
		$reference_number = null;
		$address_query_parameter = null;
		
		/* The address is used as part of an orWhere clause in the query builder */
		if (Util::isValidRequestVariable($request->address))
		{
			$address = $request->address;
			$address_query_parameter = $address;
		}
		else
		{
			$address_query_parameter = Util::convertToLikeQueryParameter('');
		}
		
		/* The suburb_id, area_id, and greater_area_id is grouped in the query builder */
		if (Util::isValidSelectRequestVariable($request->suburb_id))
		{
			$suburb_id = $request->suburb_id;
			$suburb_id_query_parameter = ['properties.suburb_id', '=', $suburb_id];
			array_push($query_parameters, $suburb_id_query_parameter);
		}
		if (Util::isValidSelectRequestVariable($request->area_id))
		{
			$area_id = $request->area_id;
			$area_id_query_parameter = ['properties.area_id', '=', $area_id];
			array_push($query_parameters, $area_id_query_parameter);
		}
		if (Util::isValidSelectRequestVariable($request->greater_area_id))
		{
			$greater_area_id = $request->greater_area_id;
			$greater_area_id_query_parameter = ['properties.greater_area_id', '=', $greater_area_id];
			array_push($query_parameters, $greater_area_id_query_parameter);
		}
		
		/* Property Flip Table parameters */
		if (Util::isValidRequestVariable($request->reference_number))
		{
			$reference_number = $request->reference_number;
			$reference_number_query_parameter = ['property_flips.reference_number', '=', $reference_number];
			array_push($query_parameters, $reference_number_query_parameter);
		}
		
		if (Util::isValidRequestVariable($request->reference_number)) /* Include join with property_flip */
		{
			$properties = DB::table('properties')
							->join('property_flips', 'properties.id', '=', 'property_flips.property_id')
							->join('suburbs', 'properties.suburb_id', '=', 'suburbs.id')
							->join('areas', 'properties.area_id', '=', 'areas.id')
							->join('greater_areas', 'properties.greater_area_id', '=', 'greater_areas.id')
							->where($query_parameters)
							->where(function ($query) use ($address_query_parameter) {
									$query->where('address_line_1', 'like', $address_query_parameter)
											->orWhere('address_line_2', 'like', $address_query_parameter)
											->orWhere('address_line_3', 'like', $address_query_parameter)
											->orWhere('address_line_4', 'like', $address_query_parameter)
											->orWhere('address_line_5', 'like', $address_query_parameter);
							})
							->select('properties.*',
									'suburbs.name as suburb_name',
									'areas.name as area_name',
									'greater_areas.name as greater_area_name')
							->paginate($user->pagination_size);
		}
		else /* Exlude join with property_flip */
		{
			$properties = DB::table('properties')
							->join('suburbs', 'properties.suburb_id', '=', 'suburbs.id')
							->join('areas', 'properties.area_id', '=', 'areas.id')
							->join('greater_areas', 'properties.greater_area_id', '=', 'greater_areas.id')
							->where($query_parameters)
							->where(function ($query) use ($address_query_parameter) {
								$query->where('address_line_1', 'like', $address_query_parameter)
								->orWhere('address_line_2', 'like', $address_query_parameter)
								->orWhere('address_line_3', 'like', $address_query_parameter)
								->orWhere('address_line_4', 'like', $address_query_parameter)
								->orWhere('address_line_5', 'like', $address_query_parameter);
							})
							->select('properties.*',
									'suburbs.name as suburb_name',
									'areas.name as area_name',
									'greater_areas.name as greater_area_name')
							->paginate($user->pagination_size);
		}			
		$suburbs = LookupUtil::retrieveSuburbsLookup();
		$areas = LookupUtil::retrieveAreasLookup();
		$greater_areas = LookupUtil::retrieveGreaterAreasLookup();
		return view('property.search-property', [
			'properties' => $properties,
			'address' => $address,
			'suburb_id' => $suburb_id,
			'area_id' => $area_id,
			'greater_area_id' => $greater_area_id,
			'reference_number' => $reference_number,
			'suburbs' => $suburbs,
			'areas' => $areas,
			'greater_areas' => $greater_areas
		]);
	}
	
	/**
	 * Load page to add an property
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddProperty()
	{
		$greater_areas = LookupUtil::retrieveGreaterAreasLookup();
		$areas = LookupUtil::retrieveAreasLookup();
		$suburbs = LookupUtil::retrieveSuburbsLookup();
		$lookup_property_types = LookupUtil::retrieveLookupPropertyTypes();
		return view('property.add-property', [
			'greater_areas' => $greater_areas,
			'areas' => $areas,
			'suburbs' => $suburbs,
			'lookup_property_types' => $lookup_property_types
		]);
	}
	
	/**
	 * Add an property
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddProperty(Request $request)
	{
		$validator = Validator::make($request->all(), [
				'address_line_1' => 'required|unique:properties',
				'portion_number' => 'numeric',
				'erf_number' => 'numeric',
				'size' => 'numeric'
		]);

		if ($validator->fails()) {
			return redirect('add-property')
				->withErrors($validator)
				->withInput();
		}
		
		$user = Auth::user();
		$property = new Property();
		$property->address_line_1 = Util::getQueryParameter($request->address_line_1);
		$property->address_line_2 = Util::getQueryParameter($request->address_line_2);
		$property->address_line_3 = Util::getQueryParameter($request->address_line_3);
		$property->address_line_4 = Util::getQueryParameter($request->address_line_4);
		$property->address_line_5 = Util::getQueryParameter($request->address_line_5);
		$property->suburb_id = Util::getQueryParameter($request->suburb_id);
		$property->area_id = Util::getQueryParameter($request->area_id);
		$property->greater_area_id = Util::getQueryParameter($request->greater_area_id);
		$property->portion_number = Util::getNumericQueryParameter($request->portion_number);
		$property->erf_number = Util::getNumericQueryParameter($request->erf_number);
		$property->size = Util::getNumericQueryParameter($request->size);
		$property->lookup_property_type_id = Util::getQueryParameter($request->lookup_property_type_id);
		$property->created_by_id = $user->id;
		$property->save();
		return redirect()->action('PropertyController@getViewProperty', ['property_Id' => $property->id])
				->with(['message' => 'Property saved']);
	}
	
	/**
	 * Load page to update an property
	 *
	 * @param Request $request
	 * @param unknown $property_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdateProperty(Request $request, $property_id)
	{
		$property = Property::find($property_id);
		$greater_areas = LookupUtil::retrieveGreaterAreasLookup();
		$areas = LookupUtil::retrieveAreasLookup();
		$suburbs = LookupUtil::retrieveSuburbsLookup();
		$lookup_property_types = LookupUtil::retrieveLookupPropertyTypes();
		return view('property.update-property', [
			'property' => $property,
			'greater_areas' => $greater_areas,
			'areas' => $areas,
			'suburbs' => $suburbs,
			'lookup_property_types' => $lookup_property_types
		]);
	}
	
	/**
	 * Update an property
	 *
	 * @param Request $request
	 * @param unknown $property_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdateProperty(Request $request, $property_id)
	{
		$validator = Validator::make($request->all(), [
				'address_line_1' => 'required',
				'portion_number' => 'numeric',
				'erf_number' => 'numeric',
				'size' => 'numeric'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('update-property', ['property_id' => $property_id])
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$property = Property::find($property_id);
		$property->address_line_1 = Util::getQueryParameter($request->address_line_1);
		$property->address_line_2 = Util::getQueryParameter($request->address_line_2);
		$property->address_line_3 = Util::getQueryParameter($request->address_line_3);
		$property->address_line_4 = Util::getQueryParameter($request->address_line_4);
		$property->address_line_5 = Util::getQueryParameter($request->address_line_5);
		$property->suburb_id = Util::getQueryParameter($request->suburb_id);
		$property->area_id = Util::getQueryParameter($request->area_id);
		$property->greater_area_id = Util::getQueryParameter($request->greater_area_id);
		$property->portion_number = Util::getQueryParameter($request->portion_number);
		$property->erf_number = Util::getQueryParameter($request->erf_number);
		$property->size = Util::getQueryParameter($request->size);
		$property->lookup_property_type_id = Util::getQueryParameter($request->lookup_property_type_id);
		$property->updated_by_id = $user->id;
		$property->save();
		return redirect()->action('PropertyController@getViewProperty', ['property_Id' => $property->id])
				->with(['message' => 'Property updated']);
	}
	
	/**
	 * Load the page to view an property
	 *
	 * @param Request $request
	 * @param unknown $property_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewProperty(Request $request, $property_id)
	{
		if ($request->session()->has(TabConstants::ACTIVE_TAB))
		{
			$request->session()->remove(TabConstants::ACTIVE_TAB);
		}
		$property = Property::find($property_id);
		return view('property.view-property', [
				'property' => $property
		]);
	}
}
