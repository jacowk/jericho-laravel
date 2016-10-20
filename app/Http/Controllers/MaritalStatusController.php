<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\LookupMaritalStatus;
use jericho\Util\Util;

/**
 * This class is a controller for performing CRUD operations on marital statuses
 *
 * @author Jaco Koekemoer
 * Date: 2016-09-23
 *
 */
class MaritalStatusController extends Controller
{
	/**
	 * Load search page
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getSearchMaritalStatus()
	{
		return view('marital-status.search-marital-status', [
			'description' => null
		]);
	}
	
	/**
	 * Search for marital statuses
	 *
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function postDoSearchMaritalStatus(Request $request)
	{
		$user = Auth::user();
		$description = null;
		if (Util::isValidRequestVariable($request->description))
		{
			$description = $request->description;
			$marital_statuses = LookupMaritalStatus::where('description', 'like', '%' . $description . '%')
									->orderBy('description', 'asc')
									->paginate($user->pagination_size);
		}
		else
		{
			$marital_statuses = LookupMaritalStatus::orderBy('description', 'asc')->paginate($user->pagination_size);
		}
		return view('marital-status.search-marital-status', [
			'marital_statuses' => $marital_statuses,
			'description' => $description
		]);
	}
	
	/**
	 * Load page to add a marital status
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddMaritalStatus()
	{
		return view('marital-status.add-marital-status');
	}
	
	/**
	 * Add a marital status
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddMaritalStatus(Request $request)
	{
// 		$this->validate($request, [
// 				'description' => 'required|unique:lookup_marital_statuses'
// 		]);

		$validator = Validator::make($request->all(), [
				'description' => 'required|unique:lookup_marital_statuses'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('add-marital-status')
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$marital_status = new LookupMaritalStatus();
		$marital_status->description = Util::getQueryParameter($request->description);
		$marital_status->created_by_id = $user->id;
		$marital_status->save();
		return redirect()->action('MaritalStatusController@getViewMaritalStatus', ['marital_status_Id' => $marital_status->id])
			->with(['message' => 'Marital Status saved']);
	}
	
	/**
	 * Load page to update a marital status
	 *
	 * @param Request $request
	 * @param unknown $marital_status_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdateMaritalStatus(Request $request, $marital_status_id)
	{
		$marital_status = LookupMaritalStatus::find($marital_status_id);
		return view('marital-status.update-marital-status', ['marital_status' => $marital_status]);
	}
	
	/**
	 * Update an marital status
	 *
	 * @param Request $request
	 * @param unknown $marital_status_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdateMaritalStatus(Request $request, $marital_status_id)
	{
// 		$this->validate($request, [
// 				'description' => 'required'
// 		]);
		$validator = Validator::make($request->all(), [
				'description' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('update-marital-status', ['marital_status_id' => $marital_status_id])
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$marital_status = LookupMaritalStatus::find($marital_status_id);
		$marital_status->description = Util::getQueryParameter($request->description);
		$marital_status->updated_by_id = $user->id;
		$marital_status->save();
		return redirect()->action('MaritalStatusController@getViewMaritalStatus', ['marital_status_Id' => $marital_status->id])
		->with(['message' => 'Marital Status updated']);
	}
	
	/**
	 * Load the page to view an marital status
	 *
	 * @param Request $request
	 * @param unknown $marital_status_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewMaritalStatus(Request $request, $marital_status_id)
	{
		$marital_status = LookupMaritalStatus::find($marital_status_id);
		return view('marital-status.view-marital-status', [
				'marital_status' => $marital_status
		]);
	}
}
