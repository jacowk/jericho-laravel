<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\LookupAttorneyType;
use jericho\Util\Util;
use jericho\Http\Controllers\Auth\AuthUserRetriever;

/**
 * This class is a controller for performing CRUD operations on attorney types
 *
 * @author Jaco Koekemoer
 * Date: 2016-09-23
 *
 */
class AttorneyTypeController extends Controller
{
	/**
	 * Load search page
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getSearchAttorneyType()
	{
		return view('attorney-type.search-attorney-type', [
				'description' => null
		]);
	}
	
	/**
	 * Search for attorney type
	 *
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function postDoSearchAttorneyType(Request $request)
	{
		$user = (new AuthUserRetriever())->retrieveUser();
		$description = null;
		if (Util::isValidRequestVariable($request->description))
		{
			$description = $request->description;
			$attorney_types = LookupAttorneyType::where('description', 'like', '%' . $description . '%')
								->orderBy('description', 'asc')
								->paginate($user->pagination_size);
		}
		else
		{
			$attorney_types = LookupAttorneyType::orderBy('description', 'asc')->paginate($user->pagination_size);
		}
		return view('attorney-type.search-attorney-type', [
			'attorney_types' => $attorney_types,
			'description' => $description
		]);
	}
	
	/**
	 * Load page to add an attorney type
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddAttorneyType()
	{
		return view('attorney-type.add-attorney-type');
	}
	
	/**
	 * Add a attorney type
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddAttorneyType(Request $request)
	{
		$validator = Validator::make($request->all(), [
				'description' => 'required|unique:lookup_attorney_types'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('add-attorney-type')
				->withErrors($validator)
				->withInput();
		}
		
		$user = (new AuthUserRetriever())->retrieveUser();
		$attorney_type = new LookupAttorneyType();
		$attorney_type->description = Util::getQueryParameter($request->description);
		$attorney_type->created_by_id = $user->id;
		$attorney_type->save();
		return redirect()->action('AttorneyTypeController@getViewAttorneyType', ['attorney_type_Id' => $attorney_type->id])
			->with(['message' => 'Attorney Type saved']);
	}
	
	/**
	 * Load page to update a attorney type
	 *
	 * @param Request $request
	 * @param unknown $attorney_type_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdateAttorneyType(Request $request, $attorney_type_id)
	{
		$attorney_type = LookupAttorneyType::find($attorney_type_id);
		return view('attorney-type.update-attorney-type', ['attorney_type' => $attorney_type]);
	}
	
	/**
	 * Update an attorney type
	 *
	 * @param Request $request
	 * @param unknown $attorney_type_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdateAttorneyType(Request $request, $attorney_type_id)
	{
		$validator = Validator::make($request->all(), [
				'description' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('update-attorney-type', ['attorney_type_id' => $attorney_type_id])
				->withErrors($validator)
				->withInput();
		}
		$user = (new AuthUserRetriever())->retrieveUser();
		$attorney_type = LookupAttorneyType::find($attorney_type_id);
		$attorney_type->description = Util::getQueryParameter($request->description);
		$attorney_type->updated_by_id = $user->id;
		$attorney_type->save();
		return redirect()->action('AttorneyTypeController@getViewAttorneyType', ['attorney_type_Id' => $attorney_type->id])
		->with(['message' => 'Attorney Type updated']);
	}
	
	/**
	 * Load the page to view an attorney type
	 *
	 * @param Request $request
	 * @param unknown $attorney_type_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewAttorneyType(Request $request, $attorney_type_id)
	{
		$attorney_type = LookupAttorneyType::find($attorney_type_id);
		return view('attorney-type.view-attorney-type', [
				'attorney_type' => $attorney_type
		]);
	}
}
