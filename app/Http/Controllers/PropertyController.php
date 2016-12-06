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
use jericho\Util\TabConstants;
use jericho\Lookup\SuburbLookupRetriever;
use jericho\Lookup\AreaLookupRetriever;
use jericho\Lookup\GreaterAreaLookupRetriever;
use jericho\Lookup\SuburbAjaxLookupRetriever;
use jericho\Lookup\PropertyTypeLookupRetriever;
use jericho\Lookup\FinanceStatusLookupRetriever;
use jericho\Lookup\SellerStatusLookupRetriever;
use jericho\Lookup\PropertyStatusLookupRetriever;
use jericho\Properties\PropertySearchResultRetriever;
use jericho\PropertyFlips\PropertyFlipSearchResultRetriever;
use DB;
use jericho\Http\Controllers\Auth\AuthUserRetriever;
use jericho\Validation\UpdateObjectValidator;
use jericho\Validation\ViewObjectValidator;

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
		$areas = (new AreaLookupRetriever())->execute();
		$greater_areas = (new GreaterAreaLookupRetriever())->execute();
		$suburbs = array(); /* Retrieved via ajax */
		$suburbs['-1'] = "Select Suburb";
		$finance_statuses = (new FinanceStatusLookupRetriever())->execute();
		$seller_statuses = (new SellerStatusLookupRetriever())->execute();
		$property_statuses = (new PropertyStatusLookupRetriever())->execute();
		return view('property.search-property', [
			'property_id' => null,
			'property_flip_id' => null,
			'address' => null,
			'suburb_id' => null,
			'area_id' => null,
			'greater_area_id' => null,
			'reference_number' => null,
			'finance_status_id' => null,
			'seller_status_id' => null,
			'property_status_id' => null,
			'suburbs' => $suburbs,
			'areas' => $areas,
			'greater_areas' => $greater_areas,
			'finance_statuses' => $finance_statuses,
			'seller_statuses' => $seller_statuses,
			'property_statuses' => $property_statuses
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
		$user = (new AuthUserRetriever())->retrieveUser();
		$address = null;
		$query_parameters = array();
		
		/* Prepare query parameters */
		$property_id = null;
		$property_flip_id = null;
		$address = null;
		$suburb_id = null;
		$area_id = null;
		$greater_area_id = null;
		$reference_number = null;
		$address_query_parameter = null;
		$finance_status_id = null;
		$seller_status_id = null;
		$property_status_id = null;
		
		/* The address is used as part of an orWhere clause in the query builder */
		if (Util::isValidRequestVariable($request->address))
		{
			$address = $request->address;
			$address_query_parameter = Util::convertToLikeQueryParameter($address);
		}
		else
		{
			$address_query_parameter = Util::convertToLikeQueryParameter('');
		}
		
		/* The propety_id, suburb_id, area_id, and greater_area_id is grouped in the query builder */
		if (Util::isValidSelectRequestVariable($request->property_id) && $request->property_id > 0)
		{
			$property_id = $request->property_id;
			$property_id_query_parameter = ['properties.id', '=', $property_id];
			array_push($query_parameters, $property_id_query_parameter);
		}
		if (Util::isValidSelectRequestVariable($request->suburb_id) && $request->suburb_id > 0)
		{
			$suburb_id = $request->suburb_id;
			$suburb_id_query_parameter = ['properties.suburb_id', '=', $suburb_id];
			array_push($query_parameters, $suburb_id_query_parameter);
		}
		if (Util::isValidSelectRequestVariable($request->area_id) && $request->area_id > 0)
		{
			$area_id = $request->area_id;
			$area_id_query_parameter = ['properties.area_id', '=', $area_id];
			array_push($query_parameters, $area_id_query_parameter);
		}
		if (Util::isValidSelectRequestVariable($request->greater_area_id) && $request->greater_area_id > 0)
		{
			$greater_area_id = $request->greater_area_id;
			$greater_area_id_query_parameter = ['properties.greater_area_id', '=', $greater_area_id];
			array_push($query_parameters, $greater_area_id_query_parameter);
		}
		
		/* Property Flip Table parameters */
		if (Util::isValidRequestVariable($request->property_flip_id))
		{
			$property_flip_id = $request->property_flip_id;
			$property_flip_id_query_parameter = ['property_flips.id', '=', $property_flip_id];
			array_push($query_parameters, $property_flip_id_query_parameter);
		}
		if (Util::isValidRequestVariable($request->reference_number))
		{
			$reference_number = $request->reference_number;
			$reference_number_query_parameter = ['property_flips.reference_number', '=', $reference_number];
			array_push($query_parameters, $reference_number_query_parameter);
		}
		if (Util::isValidSelectRequestVariable($request->finance_status_id))
		{
			$finance_status_id = $request->finance_status_id;
			$finance_status_id_query_parameter = ['property_flips.finance_status_id', '=', $finance_status_id];
			array_push($query_parameters, $finance_status_id_query_parameter);
		}
		if (Util::isValidSelectRequestVariable($request->seller_status_id))
		{
			$seller_status_id = $request->seller_status_id;
			$seller_status_id_query_parameter = ['property_flips.seller_status_id', '=', $seller_status_id];
			array_push($query_parameters, $seller_status_id_query_parameter);
		}
		if (Util::isValidSelectRequestVariable($request->property_status_id))
		{
			$property_status_id = $request->property_status_id;
			$property_status_id_query_parameter = ['property_flips.property_status_id', '=', $property_status_id];
			array_push($query_parameters, $property_status_id_query_parameter);
		}
		
		if (Util::isValidRequestVariable($request->reference_number) || 
				Util::isValidRequestVariable($request->property_flip_id) ||
				Util::isValidRequestVariable($request->finance_status_id) ||
				Util::isValidRequestVariable($request->seller_status_id) ||
				Util::isValidRequestVariable($request->property_status_id)) /* Include join with property_flip */
		{
			$properties = (new PropertyFlipSearchResultRetriever($query_parameters, $address_query_parameter, $user))->execute();
		}
		else /* Exlude join with property_flip */
		{
			$properties = (new PropertySearchResultRetriever($query_parameters, $address_query_parameter, $user))->execute();
		}			
		$suburbs = (new SuburbLookupRetriever())->execute();
		$areas = (new AreaLookupRetriever())->execute();
		$greater_areas = (new GreaterAreaLookupRetriever())->execute();
		$finance_statuses = (new FinanceStatusLookupRetriever())->execute();
		$seller_statuses = (new SellerStatusLookupRetriever())->execute();
		$property_statuses = (new PropertyStatusLookupRetriever())->execute();
		return view('property.search-property', [
			'properties' => $properties,
			'property_id' => $property_id,
			'property_flip_id' => $property_flip_id,
			'address' => $address,
			'suburb_id' => $suburb_id,
			'area_id' => $area_id,
			'greater_area_id' => $greater_area_id,
			'finance_status_id' => $finance_status_id,
			'seller_status_id' => $seller_status_id,
			'property_status_id' => $property_status_id,
			'reference_number' => $reference_number,
			'suburbs' => $suburbs,
			'areas' => $areas,
			'greater_areas' => $greater_areas,
			'finance_statuses' => $finance_statuses,
			'seller_statuses' => $seller_statuses,
			'property_statuses' => $property_statuses
		]);
	}
	
	/**
	 * Load page to add an property
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddProperty()
	{
		$areas = (new AreaLookupRetriever())->execute();
		$greater_areas = (new GreaterAreaLookupRetriever())->execute();
		$suburbs = array(); /* Retrieved via ajax */
		$suburbs['-1'] = "Select Suburb";
		$lookup_property_types = (new PropertyTypeLookupRetriever())->execute();
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
		
		$user = (new AuthUserRetriever())->retrieveUser();
		$property = new Property();
		$property->address_line_1 = Util::getQueryParameter($request->address_line_1);
		$property->address_line_2 = Util::getQueryParameter($request->address_line_2);
		$property->address_line_3 = Util::getQueryParameter($request->address_line_3);
		$property->address_line_4 = Util::getQueryParameter($request->address_line_4);
		$property->address_line_5 = Util::getQueryParameter($request->address_line_5);
		$property->suburb_id = Util::getNumericQueryParameter($request->suburb_id);
		$property->area_id = Util::getNumericQueryParameter($request->area_id);
		$property->greater_area_id = Util::getNumericQueryParameter($request->greater_area_id);
		$property->portion_number = Util::getNumericQueryParameter($request->portion_number);
		$property->erf_number = Util::getNumericQueryParameter($request->erf_number);
		$property->size = Util::getNumericQueryParameter($request->size);
		$property->lookup_property_type_id = Util::getNumericQueryParameter($request->lookup_property_type_id);
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
		(new UpdateObjectValidator())->validate($property, 'property', $property_id);
		$areas = (new AreaLookupRetriever())->execute();
		$greater_areas = (new GreaterAreaLookupRetriever())->execute();
		$suburbs = (new SuburbAjaxLookupRetriever($property->area_id))->execute();
		$lookup_property_types = (new PropertyTypeLookupRetriever())->execute();
		
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
		$user = (new AuthUserRetriever())->retrieveUser();
		$property = Property::find($property_id);
		(new UpdateObjectValidator())->validate($property, 'property', $property_id);
		$property->address_line_1 = Util::getQueryParameter($request->address_line_1);
		$property->address_line_2 = Util::getQueryParameter($request->address_line_2);
		$property->address_line_3 = Util::getQueryParameter($request->address_line_3);
		$property->address_line_4 = Util::getQueryParameter($request->address_line_4);
		$property->address_line_5 = Util::getQueryParameter($request->address_line_5);
		$property->suburb_id = Util::getNumericQueryParameter($request->suburb_id);
		$property->area_id = Util::getNumericQueryParameter($request->area_id);
		$property->greater_area_id = Util::getNumericQueryParameter($request->greater_area_id);
		$property->portion_number = Util::getQueryParameter($request->portion_number);
		$property->erf_number = Util::getQueryParameter($request->erf_number);
		$property->size = Util::getQueryParameter($request->size);
		$property->lookup_property_type_id = Util::getNumericQueryParameter($request->lookup_property_type_id);
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
		(new ViewObjectValidator())->validate($property, 'property', $property_id);
		return view('property.view-property', [
				'property' => $property
		]);
	}
}
