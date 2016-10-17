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
use jericho\Util\LookupUtil;
use DB;

class SuburbController extends Controller
{
	/**
	 * Load search page
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getSearchSuburb()
	{
		return view('suburb.search-suburb', [
			'name' => null
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
		$name = null;
		if (Util::isValidRequestVariable($request->name))
		{
			$name = $request->name;
			$suburbs = DB::table('suburbs')
							->join('areas', 'suburbs.area_id', '=', 'areas.id')
							->where('suburbs.name', 'like', '%' . $name . '%')
							->select('suburbs.*', 'areas.name as area_name')
							->orderBy('name', 'asc')
							->get();
		}
		else
		{
			/* Select all */
			$suburbs = DB::table('suburbs')
							->join('areas', 'suburbs.area_id', '=', 'areas.id')
							->select('suburbs.*', 'areas.name as area_name')
							->orderBy('name', 'asc')
							->get();
		}
		return view('suburb.search-suburb', [
			'suburbs' => $suburbs,
			'name' => $name
		]);
	}
	
	/**
	 * Load page to add an suburb
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddSuburb()
	{
		$areas = LookupUtil::retrieveAreasLookup();
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
// 		$this->validate($request, [
// 				'name' => 'required|unique:suburbs'
// 		]);
		$validator = Validator::make($request->all(), [
				'name' => 'required|unique:suburbs',
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
		$areas = LookupUtil::retrieveAreasLookup();
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
// 		$this->validate($request, [
// 				'name' => 'required'
// 		]);
		$validator = Validator::make($request->all(), [
				'name' => 'required',
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
		
// 		$areas = Area::where('name', 'like', '%' . $area . '%')
// 				->orderBy('name', 'asc')->get();
		$return_array = array();
		foreach($areas as $area)
		{
			$return_array[] = array('id' => $area->id, 'value' => $area->name);
		}
		return Response::json($return_array);
	}
}
