<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use jericho\Http\Requests;
use jericho\Milestone;
use jericho\Util\Util;
use jericho\Util\LookupUtil;
use jericho\Util\TabConstants;

class MilestoneController extends Controller
{
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
		$finance_statuses = LookupUtil::retrieveFinanceStatusLookup();
		return view('milestone.update-milestones', [
			'milestone' => $milestone,
			'finance_statuses' => $finance_statuses
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
		$user = Auth::user();
		$milestone = Milestone::find($milestone_id);
		$milestone->date_offer_made = Util::getDateQueryParameter($request->date_offer_made);
		$milestone->date_of_acceptance = Util::getDateQueryParameter($request->date_of_acceptance);
		$milestone->date_of_seller_signature = Util::getDateQueryParameter($request->date_of_seller_signature);
		$milestone->date_of_purchaser_signature = Util::getDateQueryParameter($request->date_of_purchaser_signature);
		$milestone->renovation_start_date = Util::getDateQueryParameter($request->renovation_start_date);
		$milestone->renovation_end_date = Util::getDateQueryParameter($request->renovation_end_date);
		$milestone->for_sale_date = Util::getDateQueryParameter($request->for_sale_date);
		$milestone->sell_date = Util::getDateQueryParameter($request->sell_date);
		$milestone->finance_status_id = Util::getQueryParameter($request->finance_status_id);
		$milestone->updated_by_id = $user->id;
		$milestone->save();
		return redirect()->action('PropertyFlipController@getViewPropertyFlip', ['property_flip_id' => $milestone->property_flip_id])
				->with(['message' => 'Milestone updated']);
	}
}
