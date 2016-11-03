<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\Suburb;
use jericho\Area;
use jericho\Util\Util;
use jericho\Lookup\AreaLookupRetriever;
use jericho\Lookup\SuburbAjaxLookupRetriever;

class SuburbController extends Controller
{
	/**
	 * Load search page
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getSearchSuburb()
	{
		$areas = (new AreaLookupRetriever())->execute();
		return view('suburb.search-suburb', [
			'name' => null,
			'box_code' => null,
			'street_code' => null,
			'area_id' => null,
			'areas' => $areas
		]);
	}
	
	/**
	 * Search for suburbs. I used the query builder instead of Eloquent, because I needed to get the area
	 * name in one select, using a join. 
	 *
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function postDoSearchSuburb(Request $request)
	{
		$user = Auth::user();
		$name = null;
		$box_code = null;
		$street_code = null;
		$area_id = null;
		$query_parameters = array();
		
		if (Util::isValidRequestVariable($request->name))
		{
			$name = $request->name;
			$name_query_parameter = ['name', 'like', Util::convertToLikeQueryParameter($name)];
			array_push($query_parameters, $name_query_parameter);
		}
		if (Util::isValidRequestVariable($request->box_code))
		{
			$box_code = $request->box_code;
			$box_code_query_parameter = ['box_code', 'like', $box_code];
			array_push($query_parameters, $box_code_query_parameter);
		}
		if (Util::isValidRequestVariable($request->street_code))
		{
			$street_code = $request->street_code;
			$street_code_query_parameter = ['street_code', 'like', $street_code];
			array_push($query_parameters, $street_code_query_parameter);
		}
		if (Util::isValidRequestVariable($request->area_id) && $request->area_id > -1)
		{
			$area_id = $request->area_id;
			$area_id_query_parameter = ['area_id', '=', $area_id];
			array_push($query_parameters, $area_id_query_parameter);
		}
		$suburbs = Suburb::where($query_parameters)->paginate($user->pagination_size);
		$areas = (new AreaLookupRetriever())->execute();
		return view('suburb.search-suburb', [
			'suburbs' => $suburbs,
			'name' => $name,
			'box_code' => $box_code,
			'street_code' => $street_code,
			'area_id' => $area_id,
			'areas' => $areas
		]);
	}
	
	/**
	 * Load page to add an suburb
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddSuburb()
	{
		$areas = (new AreaLookupRetriever())->execute();
		return view('suburb.add-suburb', ['areas' => $areas]);
	}
	
	/**
	 * Add an suburb
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddSuburb(Request $request)
	{
		$validator = Validator::make($request->all(), [
				'name' => 'required|unique:suburbs',
				'box_code' => 'numeric',
				'street_code' => 'numeric',
				'area_id' => 'required|not_in:-1'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('add-suburb')
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$suburb = new Suburb();
		$suburb->name = Util::getQueryParameter($request->name);
		$suburb->box_code = Util::getQueryParameter($request->box_code);
		$suburb->street_code = Util::getQueryParameter($request->street_code);
		$suburb->area_id = Util::getQueryParameter($request->area_id);
		$suburb->created_by_id = $user->id;
		$area = Area::find($suburb->area_id);
		$area->suburbs()->save($suburb);
		return redirect()->action('SuburbController@getViewSuburb', ['suburb_Id' => $suburb->id])
			->with(['message' => 'Suburb saved']);
	}
	
	/**
	 * Load page to update an suburb
	 *
	 * @param Request $request
	 * @param unknown $suburb_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdateSuburb(Request $request, $suburb_id)
	{
		$suburb = Suburb::find($suburb_id);
		$areas = (new AreaLookupRetriever())->execute();
		return view('suburb.update-suburb', ['suburb' => $suburb, 'areas' => $areas]);
	}
	
	/**
	 * Update an suburb
	 *
	 * @param Request $request
	 * @param unknown $suburb_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdateSuburb(Request $request, $suburb_id)
	{
		$validator = Validator::make($request->all(), [
				'name' => 'required',
				'box_code' => 'numeric',
				'street_code' => 'numeric',
				'area_id' => 'required|not_in:-1'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('update-suburb', ['suburb_id' => $suburb_id])
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$suburb = Suburb::find($suburb_id);
		$suburb->name = Util::getQueryParameter($request->name);
		$suburb->box_code = Util::getQueryParameter($request->box_code);
		$suburb->street_code = Util::getQueryParameter($request->street_code);
		$suburb->area_id = Util::getQueryParameter($request->area_id);
		$suburb->updated_by_id = $user->id;
		$suburb->save();
		return redirect()->action('SuburbController@getViewSuburb', ['suburb_Id' => $suburb->id])
		->with(['message' => 'Suburb updated']);
	}
	
	/**
	 * Load the page to view an suburb
	 *
	 * @param Request $request
	 * @param unknown $suburb_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewSuburb(Request $request, $suburb_id)
	{
		$suburb = Suburb::find($suburb_id);
		return view('suburb.view-suburb', [
				'suburb' => $suburb
		]);
	}
	
	public function autocompleteAreas(Request $request)
	{
		$area = $request->area;
		$areas = Area::select('name')->where('name', 'like', '%' . $area . '%')->get();
		$return_array = array();
		foreach($areas as $area)
		{
			$return_array[] = array('id' => $area->id, 'value' => $area->name);
		}
		return Response::json($return_array);
	}
	
	
	public function postAjaxRetrieveSuburbsForArea(Request $request)
	{
		$area_id = Util::getQueryParameter($request->area_id);
		$suburbs_for_area = (new SuburbAjaxLookupRetriever($area_id))->execute();
		return json_encode($suburbs_for_area);
	}
}
