<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Util\Util;
use jericho\Http\Requests;
use jericho\GreaterArea;

class GreaterAreaController extends Controller
{
	/**
	 * Load search page
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getSearchGreaterArea()
	{
		return view('greater-area.search-greater-area', [
			'name' => null
		]);
	}
	
	/**
	 * Search for greater_areas
	 *
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function postDoSearchGreaterArea(Request $request)
	{
		$user = Auth::user();
		$name = null;
		if (Util::isValidRequestVariable($request->name))
		{
			$name = $request->name;
			$greater_areas = GreaterArea::where('name', 'like', '%' . $name . '%')->orderBy('name', 'asc')->paginate($user->pagination_size);
		}
		else
		{
			$greater_areas = GreaterArea::orderBy('name', 'asc')->paginate($user->pagination_size);
		}
		return view('greater-area.search-greater-area', [
			'greater_areas' => $greater_areas,
			'name' => $name
		]);
	}
	
	/**
	 * Load page to add an greater_area
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddGreaterArea()
	{
		return view('greater-area.add-greater-area');
	}
	
	/**
	 * Add an greater_area
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddGreaterArea(Request $request)
	{
		$validator = Validator::make($request->all(), [
				'name' => 'required|unique:greater_areas'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('add-greater-area')
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$greater_area = new GreaterArea();
		$greater_area->name = Util::getQueryParameter($request->name);
		$greater_area->created_by_id = $user->id;
		$greater_area->save();
		return redirect()->action('GreaterAreaController@getViewGreaterArea', ['greater_area_Id' => $greater_area->id])
		->with(['message' => 'Greater Area saved']);
	}
	
	/**
	 * Load page to update an greater_area
	 *
	 * @param Request $request
	 * @param unknown $greater_area_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdateGreaterArea(Request $request, $greater_area_id)
	{
		$greater_area = GreaterArea::find($greater_area_id);
		return view('greater-area.update-greater-area', ['greater_area' => $greater_area]);
	}
	
	/**
	 * Update an greater_area
	 *
	 * @param Request $request
	 * @param unknown $greater_area_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdateGreaterArea(Request $request, $greater_area_id)
	{
		$validator = Validator::make($request->all(), [
				'name' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('update-greater-area', ['greater_area_id' => $greater_area_id])
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$greater_area = GreaterArea::find($greater_area_id);
		$greater_area->name = Util::getQueryParameter($request->name);
		$greater_area->updated_by_id = $user->id;
		$greater_area->save();
		return redirect()->action('GreaterAreaController@getViewGreaterArea', ['greater_area_Id' => $greater_area->id])
		->with(['message' => 'Greater Area updated']);
	}
	
	/**
	 * Load the page to view an greater_area
	 *
	 * @param Request $request
	 * @param unknown $greater_area_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewGreaterArea(Request $request, $greater_area_id)
	{
		$greater_area = GreaterArea::find($greater_area_id);
		return view('greater-area.view-greater-area', [
				'greater_area' => $greater_area
		]);
	}
}
