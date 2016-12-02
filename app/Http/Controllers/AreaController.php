<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\Area;
use jericho\Util\Util;
use jericho\Http\Controllers\Auth\AuthUserRetriever;

/**
 * This class is a controller for performing CRUD operations on areas
 *
 * @author Jaco Koekemoer
 * Date: 2016-09-14
 *
 */
class AreaController extends Controller
{
	/**
	 * Load search page
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getSearchArea()
	{
		return view('area.search-area', [
			'name' => null
		]);
	}
	
	/**
	 * Search for areas
	 *
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function postDoSearchArea(Request $request)
	{
		$user = (new AuthUserRetriever())->retrieveUser();
		$name = null;
		if (Util::isValidRequestVariable($request->name))
		{
			$name = $request->name;
			$areas = Area::where('name', 'like', '%' . $name . '%')->orderBy('name', 'asc')->paginate($user->pagination_size);
		}
		else
		{
			$areas = Area::orderBy('name', 'asc')->paginate($user->pagination_size);
		}
		//Illuminate\Pagination\LengthAwarePaginator
		return view('area.search-area', [
			'areas' => $areas,
			'name' => $name
		]);
	}
	
	/**
	 * Load page to add an area
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddArea()
	{
		return view('area.add-area');
	}
	
	/**
	 * Add an area
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddArea(Request $request)
	{
		$validator = Validator::make($request->all(), [
				'name' => 'required|unique:areas'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('add-area')
				->withErrors($validator)
				->withInput();
		}
		
		$user = (new AuthUserRetriever())->retrieveUser();
		$area = new Area();
		$area->name = Util::getQueryParameter($request->name);
		$area->created_by_id = $user->id;
		$area->save();
		return redirect()->action('AreaController@getViewArea', ['area_Id' => $area->id])
		->with(['message' => 'Area saved']);
	}
	
	/**
	 * Load page to update an area
	 *
	 * @param Request $request
	 * @param unknown $area_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdateArea(Request $request, $area_id)
	{
		$area = Area::find($area_id);
		return view('area.update-area', ['area' => $area]);
	}
	
	/**
	 * Update an area
	 *
	 * @param Request $request
	 * @param unknown $area_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdateArea(Request $request, $area_id)
	{
		$validator = Validator::make($request->all(), [
				'name' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('update-area', ['area_id' => $area_id])
				->withErrors($validator)
				->withInput();
		}
		$user = (new AuthUserRetriever())->retrieveUser();
		$area = Area::find($area_id);
		$area->name = Util::getQueryParameter($request->name);
		$area->updated_by_id = $user->id;
		$area->save();
		return redirect()->action('AreaController@getViewArea', ['area_Id' => $area->id])
		->with(['message' => 'Area updated']);
	}
	
	/**
	 * Load the page to view an area
	 *
	 * @param Request $request
	 * @param unknown $area_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewArea(Request $request, $area_id)
	{
		$area = Area::find($area_id);
		return view('area.view-area', [
				'area' => $area
		]);
	}
}
