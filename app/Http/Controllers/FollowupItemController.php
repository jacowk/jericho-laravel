<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\DiaryItem;
use jericho\FollowupItem;
use jericho\PropertyFlip;
use jericho\Util\Util;

/**
 * This class is a controller for performing CRUD operations on followup items
 *
 * @author Jaco Koekemoer
 * Date: 2016-09-22
 *
 */
class FollowupItemController extends Controller
{
	/**
	 * Load page to add an followup
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddFollowupItem(Request $request, $diary_item_id)
	{
		return view('followup.add-followup-item', [
			'diary_item_id' => $diary_item_id
		]);
	}
	
	/**
	 * Add an followup
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddFollowupItem(Request $request)
	{
// 		$this->validate($request, [
// 				'comments' => 'required'
// 		]);
		$validator = Validator::make($request->all(), [
				'comments' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('add-followup-item', ['diary_item_id' => $request->diary_item_id])
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$followup_item = new FollowupItem();
		$followup_item->comments = Util::getQueryParameter($request->comments);
		$followup_item->created_by_id = $user->id;
		
		$diary_item = DiaryItem::find($request->diary_item_id);
		$diary_item->followup_items()->save($followup_item);
		
		return redirect()->action('DiaryItemController@getViewDiaryItem', ['diary_item_id' => $diary_item->id])
			->with(['message' => 'Followup Item added']);
	}
	
	/**
	 * Load page to update an followup
	 *
	 * @param Request $request
	 * @param unknown $followup_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdateFollowupItem(Request $request, $followup_item_id)
	{
		$followup_item = FollowupItem::find($followup_item_id);
		return view('followup.update-followup-item', ['followup_item' => $followup_item]);
	}
	
	/**
	 * Update an followup
	 *
	 * @param Request $request
	 * @param unknown $followup_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdateFollowupItem(Request $request, $followup_item_id)
	{
// 		$this->validate($request, [
// 				'comments' => 'required'
// 		]);
		$validator = Validator::make($request->all(), [
				'comments' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('update-followup-item', ['followup_item_id' => $followup_item_id])
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$followup_item = FollowupItem::find($followup_item_id);
		$followup_item->comments = Util::getQueryParameter($request->comments);
		$followup_item->updated_by_id = $user->id;
		$followup_item->save();
		return redirect()->action('DiaryItemController@getViewDiaryItem', ['diary_item_id' => $followup_item->diary_item->id])
			->with(['message' => 'Followup Item updated']);
	}
	
	/**
	 * Load the page to view an followup
	 *
	 * @param Request $request
	 * @param unknown $followup_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewFollowupItem(Request $request, $followup_item_id)
	{
		$followup_item = FollowupItem::find($followup_item_id);
		return view('followup.view-followup-item', [
			'followup_item' => $followup_item
		]);
	}
}
