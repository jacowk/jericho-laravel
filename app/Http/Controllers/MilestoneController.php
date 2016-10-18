<?php
namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\Milestone;
use jericho\PropertyFlip;
use jericho\Util\Util;
use jericho\Util\LookupUtil;
use jericho\Util\TabConstants;

/**
 * This class is a controller for performing CRUD operations on milestones
 *
 * @author Jaco Koekemoer
 * Date: 2016-10-14
 *
 */
class MilestoneController extends Controller
{
	/**
	 * Load page to add an milestone
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddMilestone(Request $request, $property_flip_id)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::MILESTONES_TAB);
		$lookup_milestone_types = LookupUtil::retrieveLookupMilestoneTypes();
		return view('milestone.add-milestone', [
				'property_flip_id' => $property_flip_id,
				'lookup_milestone_types' => $lookup_milestone_types
		]);
	}

	/**
	 * Add an milestone
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddMilestone(Request $request)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::MILESTONES_TAB);
		$validator = Validator::make($request->all(), [
				'effective_date' => 'required|date',
				'milestone_type_id' => 'required|not_in:-1',
				'property_flip_id' => 'required|not_in:-1'
		]);

		if ($validator->fails()) {
			return redirect()
				->route('add-milestone', ['property_flip_id' => $request->property_flip_id])
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$milestone = new Milestone();
		$milestone->effective_date = Util::getDateQueryParameter($request->effective_date);
		$milestone->milestone_type_id = Util::getNumericQueryParameter($request->milestone_type_id);
		$milestone->property_flip_id = Util::getNumericQueryParameter($request->property_flip_id);
		$milestone->created_by_id = $user->id;
		$property_flip = PropertyFlip::find($request->property_flip_id);
		$property_flip->milestones()->save($milestone);
		return redirect()->action('PropertyFlipController@getViewPropertyFlip', ['property_flip_id' => $property_flip->id])
			->with(['message' => 'Milestone added']);
	}

	/**
	 * Load page to update an milestone
	 *
	 * @param Request $request
	 * @param unknown $milestone_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdateMilestone(Request $request, $milestone_id)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::MILESTONES_TAB);
		$milestone = Milestone::find($milestone_id);
		$lookup_milestone_types = LookupUtil::retrieveLookupMilestoneTypes();
		return view('milestone.update-milestone', [
			'milestone' => $milestone,
			'lookup_milestone_types' => $lookup_milestone_types
		]);
	}

	/**
	 * Update an milestone
	 *
	 * @param Request $request
	 * @param unknown $milestone_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdateMilestone(Request $request, $milestone_id)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::MILESTONES_TAB);
		$validator = Validator::make($request->all(), [
				'effective_date' => 'required',
				'milestone_type_id' => 'required|not_in:-1'
		]);

		if ($validator->fails()) {
			return redirect()
				->route('update-milestone', ['milestone_id' => $milestone_id ])
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$milestone = Milestone::find($milestone_id);
		$milestone->effective_date = Util::getDateQueryParameter($request->effective_date);
		$milestone->milestone_type_id = Util::getNumericQueryParameter($request->milestone_type_id);
		$milestone->updated_by_id = $user->id;
		$milestone->save();
		return redirect()->action('PropertyFlipController@getViewPropertyFlip', ['property_flip_id' => $milestone->property_flip->id])
		->with(['message' => 'Milestone updated']);
	}

	/**
	 * Load the page to view an milestone
	 *
	 * @param Request $request
	 * @param unknown $milestone_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewMilestone(Request $request, $milestone_id)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::MILESTONES_TAB);
		$milestone = Milestone::find($milestone_id);
		return view('milestone.view-milestone', [
				'milestone' => $milestone
		]);
	}
}
