<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\LookupMilestoneType;
use jericho\Util\Util;

/**
 * This class is a controller for performing CRUD operations on milestone types
 *
 * @author Jaco Koekemoer
 * Date: 2016-10-13
 *
 */
class MilestoneTypeController extends Controller
{
	/**
	 * Load search page
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getSearchMilestoneType()
	{
		return view('milestone-type.search-milestone-type', [
			'description' => null
		]);
	}
	
	/**
	 * Search for milestone type
	 *
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function postDoSearchMilestoneType(Request $request)
	{
		$user = Auth::user();
		$description = null;
		if (Util::isValidRequestVariable($request->description))
		{
			$description = $request->description;
			$milestone_types = LookupMilestoneType::where('description', 'like', '%' . $description . '%')
								->orderBy('description', 'asc')
								->paginate($user->pagination_size);
		}
		else
		{
			$milestone_types = LookupMilestoneType::orderBy('description', 'asc')->paginate($user->pagination_size);
		}
		return view('milestone-type.search-milestone-type', [
				'milestone_types' => $milestone_types,
				'description' => $description
		]);
	}
	
	/**
	 * Load page to add an milestone type
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddMilestoneType()
	{
		return view('milestone-type.add-milestone-type');
	}
	
	/**
	 * Add a milestone type
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddMilestoneType(Request $request)
	{
// 		$this->validate($request, [
// 				'description' => 'required|unique:lookup_milestone_types'
// 		]);
		$validator = Validator::make($request->all(), [
				'description' => 'required|unique:lookup_milestone_types'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('add-milestone-type')
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$milestone_type = new LookupMilestoneType();
		$milestone_type->description = Util::getQueryParameter($request->description);
		$milestone_type->created_by_id = $user->id;
		$milestone_type->save();
		return redirect()->action('MilestoneTypeController@getViewMilestoneType', ['milestone_type_Id' => $milestone_type->id])
			->with(['message' => 'Milestone Type saved']);
	}
	
	/**
	 * Load page to update a milestone type
	 *
	 * @param Request $request
	 * @param unknown $milestone_type_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdateMilestoneType(Request $request, $milestone_type_id)
	{
		$milestone_type = LookupMilestoneType::find($milestone_type_id);
		return view('milestone-type.update-milestone-type', ['milestone_type' => $milestone_type]);
	}
	
	/**
	 * Update an milestone type
	 *
	 * @param Request $request
	 * @param unknown $milestone_type_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdateMilestoneType(Request $request, $milestone_type_id)
	{
// 		$this->validate($request, [
// 				'description' => 'required'
// 		]);
		$validator = Validator::make($request->all(), [
				'description' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('update-milestone-type', ['milestone_type_id' => $milestone_type_id])
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$milestone_type = LookupMilestoneType::find($milestone_type_id);
		$milestone_type->description = Util::getQueryParameter($request->description);
		$milestone_type->updated_by_id = $user->id;
		$milestone_type->save();
		return redirect()->action('MilestoneTypeController@getViewMilestoneType', ['milestone_type_Id' => $milestone_type->id])
		->with(['message' => 'Milestone Type updated']);
	}
	
	/**
	 * Load the page to view an milestone type
	 *
	 * @param Request $request
	 * @param unknown $milestone_type_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewMilestoneType(Request $request, $milestone_type_id)
	{
		$milestone_type = LookupMilestoneType::find($milestone_type_id);
		return view('milestone-type.view-milestone-type', [
				'milestone_type' => $milestone_type
		]);
	}
}
