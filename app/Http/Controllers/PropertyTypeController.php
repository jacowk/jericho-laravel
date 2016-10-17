<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\LookupPropertyType;
use jericho\Util\Util;

/**
 * This class is a controller for performing CRUD operations on property types
 *
 * @author Jaco Koekemoer
 * Date: 2016-10-03
 *
 */
class PropertyTypeController extends Controller
{
	/**
	 * Load search page
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getSearchPropertyType()
	{
		return view('property-type.search-property-type', [
			'description' => null
		]);
	}
	
	/**
	 * Search for property type
	 *
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function postDoSearchPropertyType(Request $request)
	{
		$description = null;
		if (Util::isValidRequestVariable($request->description))
		{
			$description = $request->description;
			$property_types = LookupPropertyType::where('description', 'like', '%' . $description . '%')->orderBy('description', 'asc')->get();
		}
		else
		{
			$property_types = LookupPropertyType::orderBy('description', 'asc')->get();
		}
		return view('property-type.search-property-type', [
				'property_types' => $property_types,
				'description' => $description
		]);
	}
	
	/**
	 * Load page to add an property type
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddPropertyType()
	{
		return view('property-type.add-property-type');
	}
	
	/**
	 * Add a property type
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddPropertyType(Request $request)
	{
// 		$this->validate($request, [
// 				'description' => 'required|unique:lookup_property_types'
// 		]);
		$validator = Validator::make($request->all(), [
				'description' => 'required|unique:lookup_property_types'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('add-property-type')
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$property_type = new LookupPropertyType();
		$property_type->description = Util::getQueryParameter($request->description);
		$property_type->created_by_id = $user->id;
		$property_type->save();
		return redirect()->action('PropertyTypeController@getViewPropertyType', ['property_type_Id' => $property_type->id])
			->with(['message' => 'Property Type saved']);
	}
	
	/**
	 * Load page to update a property type
	 *
	 * @param Request $request
	 * @param unknown $property_type_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdatePropertyType(Request $request, $property_type_id)
	{
		$property_type = LookupPropertyType::find($property_type_id);
		return view('property-type.update-property-type', ['property_type' => $property_type]);
	}
	
	/**
	 * Update an property type
	 *
	 * @param Request $request
	 * @param unknown $property_type_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdatePropertyType(Request $request, $property_type_id)
	{
// 		$this->validate($request, [
// 				'description' => 'required'
// 		]);
		$validator = Validator::make($request->all(), [
				'description' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('update-property-type', ['property_type_id' => $property_type_id])
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$property_type = LookupPropertyType::find($property_type_id);
		$property_type->description = Util::getQueryParameter($request->description);
		$property_type->updated_by_id = $user->id;
		$property_type->save();
		return redirect()->action('PropertyTypeController@getViewPropertyType', ['property_type_Id' => $property_type->id])
		->with(['message' => 'Property Type updated']);
	}
	
	/**
	 * Load the page to view an property type
	 *
	 * @param Request $request
	 * @param unknown $property_type_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewPropertyType(Request $request, $property_type_id)
	{
		$property_type = LookupPropertyType::find($property_type_id);
		return view('property-type.view-property-type', [
				'property_type' => $property_type
		]);
	}
}
