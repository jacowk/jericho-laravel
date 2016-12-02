<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\DiaryItem;
use jericho\DiaryItemComment;
use jericho\PropertyFlip;
use jericho\Util\Util;
use jericho\Http\Controllers\Auth\AuthUserRetriever;

/**
 * This class is a controller for performing CRUD operations on diay item comments
 *
 * @author Jaco Koekemoer
 * Date: 2016-10-19
 *
 */
class DiaryItemCommentController extends Controller
{
	/**
	 * Load page to add an followup
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddDiaryItemComment(Request $request, $diary_item_id)
	{
		return view('diary-item-comment.add-diary-item-comment', [
			'diary_item_id' => $diary_item_id
		]);
	}
	
	/**
	 * Add an followup
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddDiaryItemComment(Request $request)
	{
		$validator = Validator::make($request->all(), [
				'comment' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('add-diary-item-comment', ['diary_item_id' => $request->diary_item_id])
				->withErrors($validator)
				->withInput();
		}
		$user = (new AuthUserRetriever())->retrieveUser();
		$diary_item_comment = new DiaryItemComment();
		$diary_item_comment->comment = Util::getQueryParameter($request->comment);
		$diary_item_comment->created_by_id = $user->id;
		
		$diary_item = DiaryItem::find($request->diary_item_id);
		$diary_item->diary_item_comments()->save($diary_item_comment);
		
		return redirect()->action('DiaryItemController@getViewDiaryItem', ['diary_item_id' => $diary_item->id])
			->with(['message' => 'Diary Item Comment added']);
	}
	
	/**
	 * Load page to update an followup
	 *
	 * @param Request $request
	 * @param unknown $followup_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdateDiaryItemComment(Request $request, $diary_item_comment_id)
	{
		$diary_item_comment = DiaryItemComment::find($diary_item_comment_id);
		return view('diary-item-comment.update-diary-item-comment', ['diary_item_comment' => $diary_item_comment]);
	}
	
	/**
	 * Update an followup
	 *
	 * @param Request $request
	 * @param unknown $followup_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdateDiaryItemComment(Request $request, $diary_item_comment_id)
	{
		$validator = Validator::make($request->all(), [
				'comment' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('update-diary-item-comment', ['diary_item_comment_id' => $diary_item_comment_id])
				->withErrors($validator)
				->withInput();
		}
		$user = (new AuthUserRetriever())->retrieveUser();
		$diary_item_comment = DiaryItemComment::find($diary_item_comment_id);
		$diary_item_comment->comment = Util::getQueryParameter($request->comment);
		$diary_item_comment->updated_by_id = $user->id;
		$diary_item_comment->save();
		return redirect()->action('DiaryItemController@getViewDiaryItem', ['diary_item_id' => $diary_item_comment->diary_item->id])
			->with(['message' => 'Diary Item Comment updated']);
	}
	
	/**
	 * Load the page to view an followup
	 *
	 * @param Request $request
	 * @param unknown $followup_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewDiaryItemComment(Request $request, $diary_item_comment_id)
	{
		$diary_item_comment = DiaryItemComment::find($diary_item_comment_id);
		return view('diary-item-comment.view-diary-item-comment', [
			'diary_item_comment' => $diary_item_comment
		]);
	}
}
