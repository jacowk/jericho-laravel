<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\DiaryItem;
use jericho\Util\Util;
use jericho\Util\TabConstants;
use jericho\Lookup\DiaryItemStatusLookupRetriever;
use jericho\Lookup\UserLookupRetriever;
use jericho\Http\Controllers\Auth\AuthUserRetriever;

/**
 * This class is a controller for performing CRUD operations on diary items
 *
 * @author Jaco Koekemoer
 * Date: 2016-09-22
 *
 */
class DiaryItemController extends Controller
{
	/**
	 * Load page to add an diary_item
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddDiaryItem(Request $request, $property_flip_id)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::DIARY_TAB);
		$lookup_users = (new UserLookupRetriever())->execute();
		return view('diary.add-diary-item', [
			'property_flip_id' => $property_flip_id,
			'lookup_users' => $lookup_users
		]);
	}
	
	/**
	 * Add an diary_item
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddDiaryItem(Request $request)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::DIARY_TAB);

		$validator = Validator::make($request->all(), [
			'followup_date' => 'required',
			'followup_user_id' => 'required|not_in:-1',
			'comments' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('add-diary-item', ['property_flip_id' => $request->property_flip_id])
				->withErrors($validator)
				->withInput();
		}
		
		$user = (new AuthUserRetriever())->retrieveUser();
		$diary_item = new DiaryItem();
		$diary_item->property_flip_id = Util::getNumericQueryParameter($request->property_flip_id);
		$diary_item->status_id = 1; /* Open */
		$diary_item->followup_date = Util::getQueryParameter($request->followup_date);
		$diary_item->followup_user_id = Util::getNumericQueryParameter($request->followup_user_id);
		$diary_item->comments = Util::getQueryParameter($request->comments);
		$diary_item->created_by_id = $user->id;
		$diary_item->save();
		return redirect()->action('DiaryItemController@getViewDiaryItem', ['diary_item_Id' => $diary_item->id])
			->with(['message' => 'Diary Item added']);
	}
	
	/**
	 * Load page to update an diary_item
	 *
	 * @param Request $request
	 * @param unknown $diary_item_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdateDiaryItem(Request $request, $diary_item_id)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::DIARY_TAB);
		$diary_item = DiaryItem::find($diary_item_id);
		$diary_item_statuses = (new DiaryItemStatusLookupRetriever())->execute();
		$lookup_users = (new UserLookupRetriever())->execute();
		return view('diary.update-diary-item', [
			'diary_item' => $diary_item,
			'lookup_users' => $lookup_users,
			'diary_item_statuses' => $diary_item_statuses
		]);
	}
	
	/**
	 * Update an diary_item
	 *
	 * @param Request $request
	 * @param unknown $diary_item_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdateDiaryItem(Request $request, $diary_item_id)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::DIARY_TAB);
		$validator = Validator::make($request->all(), [
			'followup_date' => 'required',
			'followup_user_id' => 'required|not_in:-1',
			'comments' => 'required',
			'status_id' => 'required|not_in:-1'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('update-diary-item', ['diary_item_id' => $diary_item_id ])
				->withErrors($validator)
				->withInput();
		}
		$user = (new AuthUserRetriever())->retrieveUser();
		$diary_item = DiaryItem::find($diary_item_id);
		$diary_item->status_id = Util::getNumericQueryParameter($request->status_id);
		$diary_item->followup_date = Util::getQueryParameter($request->followup_date);
		$diary_item->followup_user_id = Util::getNumericQueryParameter($request->followup_user_id);
		$diary_item->comments = Util::getQueryParameter($request->comments);
		$diary_item->updated_by_id = $user->id;
		$diary_item->save();
		return redirect()->action('DiaryItemController@getViewDiaryItem', ['diary_item_Id' => $diary_item->id])
			->with(['message' => 'Diary Item updated']);
	}
	
	/**
	 * Load the page to view an diary_item
	 *
	 * @param Request $request
	 * @param unknown $diary_item_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewDiaryItem(Request $request, $diary_item_id)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::DIARY_TAB);
		$diary_item = DiaryItem::find($diary_item_id);
		return view('diary.view-diary-item', [
				'diary_item' => $diary_item
		]);
	}
}
