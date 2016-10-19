<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\IssueComment;
use jericho\Issue;
use jericho\Util\Util;
use jericho\Util\TabConstants;

/**
 * This class is a controller for performing CRUD operations on issue comments
 *
 * @author Jaco Koekemoer
 * Date: 2016-10-19
 *
 */
class IssueCommentController extends Controller
{
	/**
	 * Load page to add an issue comment
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddIssueComment(Request $request, $issue_id)
	{
		return view('issue-comment.add-issue-comment', [
			'issue_id' => $issue_id
		]);
	}
	
	/**
	 * Add an issue comment
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddIssueComment(Request $request)
	{
// 		$this->validate($request, [
// 				'description' => 'required'
// 		]);
		$validator = Validator::make($request->all(), [
				'comment' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('add-issue-comment', ['issue_id' => $request->issue_id])
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$issue_comment = new IssueComment();
		$issue_comment->comment = Util::getQueryParameter($request->comment);
		$issue_comment->created_by_id = $user->id;
		
		$issue = Issue::find($request->issue_id);
		$issue->issue_comments()->save($issue_comment);
		
		return redirect()->action('IssueController@getViewIssue', ['issue_id' => $issue->id])
			->with(['message' => 'IssueComment added']);
	}
	
	/**
	 * Load page to update an issue comment
	 *
	 * @param Request $request
	 * @param unknown $issue_comment_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdateIssueComment(Request $request, $issue_comment_id)
	{
		$issue_comment = IssueComment::find($issue_comment_id);
		return view('issue-comment.update-issue-comment', ['issue_comment' => $issue_comment]);
	}
	
	/**
	 * Update an issue comment
	 *
	 * @param Request $request
	 * @param unknown $issue_comment_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdateIssueComment(Request $request, $issue_comment_id)
	{
// 		$this->validate($request, [
// 				'description' => 'required'
// 		]);
		$validator = Validator::make($request->all(), [
				'comment' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('update-issue-comment', ['issue_comment_id' => $issue_comment_id ])
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$issue_comment = IssueComment::find($issue_comment_id);
		$issue_comment->comment = Util::getQueryParameter($request->comment);
		$issue_comment->updated_by_id = $user->id;
		$issue_comment->save();
		return redirect()->action('IssueController@getViewIssue', ['issue_id' => $issue_comment->issue->id])
			->with(['message' => 'Issue Comment updated']);
	}
	
	/**
	 * Load the page to view an issue comment
	 *
	 * @param Request $request
	 * @param unknown $issue_comment_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewIssueComment(Request $request, $issue_comment_id)
	{
		$issue_comment = IssueComment::find($issue_comment_id);
		return view('issue-comment.view-issue-comment', [
				'issue_comment' => $issue_comment
		]);
	}
}
