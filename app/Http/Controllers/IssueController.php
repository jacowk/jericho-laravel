<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\Issue;
use jericho\IssueStatus;
use jericho\Util\Util;
use jericho\Lookup\UserLookupRetriever;
use jericho\Lookup\IssueComponentLookupRetriever;
use jericho\Lookup\IssueCategoryLookupRetriever;
use jericho\Lookup\IssueSeverityLookupRetriever;
use jericho\Lookup\IssueStatusLookupRetriever;

/**
 * This class is a controller for performing CRUD operations on issues
 *
 * @author Jaco Koekemoer
 * Date: 2016-10-19
 *
 */
class IssueController extends Controller
{
	/**
	 * Load search page
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getSearchIssue()
	{
		$users = (new UserLookupRetriever())->execute();
		$issue_statuses = (new IssueStatusLookupRetriever)->execute();
		return view('issue.search-issue', [
			'users' => $users,
			'issue_statuses' => $issue_statuses,
			'id' => null,
			'assigned_to_id' => null,
			'issue_status_id' => null,
			'created_by_id' => null
		]);
	}
	
	/**
	 * Search for issues
	 *
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function postDoSearchIssue(Request $request)
	{
		$user = Auth::user();
		$id = null;
		$created_by_id = null;
		$assigned_to_id = null;
		$issue_status_id = null;
		$query_parameters = array();
		/* Prepare query parameters */
		if (Util::isValidRequestVariable($request->id))
		{
			$id = $request->id;
			$id_query_parameter = ['id', '=', $id];
			array_push($query_parameters, $id_query_parameter);
		}
		if (Util::isValidSelectRequestVariable($request->created_by_id))
		{
			$created_by_id = $request->created_by_id;
			$created_by_id_query_parameter = ['created_by_id', '=', $created_by_id];
			array_push($query_parameters, $created_by_id_query_parameter);
		}
		if (Util::isValidSelectRequestVariable($request->assigned_to_id))
		{
			$assigned_to_id = $request->assigned_to_id;
			$assigned_to_query_parameter = ['assigned_to_id', '=', $assigned_to_id];
			array_push($query_parameters, $assigned_to_query_parameter);
		}
		if (Util::isValidSelectRequestVariable($request->issue_status_id))
		{
			$issue_status_id = $request->issue_status_id;
			$issue_status_id_query_parameter = ['issue_status_id', '=', $issue_status_id];
			array_push($query_parameters, $issue_status_id_query_parameter);
		}
		/* Do the search using the query parameters */
		$issues = Issue::where($query_parameters)
						->orderBy('created_at', 'desc')
						->paginate($user->pagination_size);
		/* Prepare screen parameters */
		$users = (new UserLookupRetriever())->execute();;
		$issue_statuses = (new IssueStatusLookupRetriever)->execute();
		
		/* Return to view */
		return view('issue.search-issue', [
			'issues' => $issues,
			'users' => $users,
			'issue_statuses' => $issue_statuses,
			'id' => $id,
			'assigned_to_id' => $assigned_to_id,
			'issue_status_id' => $issue_status_id,
			'created_by_id' => $created_by_id
		]);
	}
	
	/**
	 * Load page to add an issue
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddIssue()
	{
		$users = (new UserLookupRetriever())->execute();
		$issue_components = (new IssueComponentLookupRetriever)->execute();
		$issue_categories = (new IssueCategoryLookupRetriever)->execute();
		$issue_severity_list = (new IssueSeverityLookupRetriever)->execute();
		$issue_statuses = (new IssueStatusLookupRetriever)->execute();
		
		return view('issue.add-issue', [
			'users' => $users,
			'issue_components' => $issue_components,
			'issue_categories' => $issue_categories,
			'issue_severity_list' => $issue_severity_list,
			'issue_statuses' => $issue_statuses
		]);
	}
	
	/**
	 * Add an issue
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddIssue(Request $request)
	{
		$validator = Validator::make($request->all(), [
				'assigned_to_id' => 'required|not_in:-1',
				'description' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('add-issue')
				->withErrors($validator)
				->withInput();
		}
		
		$new_status = IssueStatus::where('description', 'like', 'New')->first();
		$user = Auth::user();
		$issue = new Issue();
		$issue->assigned_to_id = Util::getNumericQueryParameter($request->assigned_to_id);
		$issue->lookup_issue_component_id = Util::getNumericQueryParameter($request->lookup_issue_component_id);
		$issue->lookup_issue_category_id = Util::getNumericQueryParameter($request->lookup_issue_category_id);
		$issue->lookup_issue_severity_id = Util::getNumericQueryParameter($request->lookup_issue_severity_id);
		$issue->issue_status_id = $new_status->id; /* New status */
		$issue->description = Util::getQueryParameter($request->description);
		$issue->created_by_id = $user->id;
		$issue->save();
		return redirect()->action('IssueController@getViewIssue', ['issue_Id' => $issue->id])
			->with(['message' => 'Issue saved']);
	}
	
	/**
	 * Load page to update an issue
	 *
	 * @param Request $request
	 * @param unknown $issue_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdateIssue(Request $request, $issue_id)
	{
		$users = (new UserLookupRetriever())->execute();
		$issue_components = (new IssueComponentLookupRetriever)->execute();
		$issue_categories = (new IssueCategoryLookupRetriever)->execute();
		$issue_severity_list = (new IssueSeverityLookupRetriever)->execute();
		$issue_statuses = (new IssueStatusLookupRetriever)->execute();
		
		$issue = Issue::find($issue_id);
		return view('issue.update-issue', [
			'issue' => $issue,
			'users' => $users,
			'issue_components' => $issue_components,
			'issue_categories' => $issue_categories,
			'issue_severity_list' => $issue_severity_list,
			'issue_statuses' => $issue_statuses
		]);
	}
	
	/**
	 * Update an issue
	 *
	 * @param Request $request
	 * @param unknown $issue_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdateIssue(Request $request, $issue_id)
	{
		$validator = Validator::make($request->all(), [
				'assigned_to_id' => 'required|not_in:-1',
				'description' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('update-issue', ['issue_id' => $issue_id])
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$issue = Issue::find($issue_id);
		$issue->assigned_to_id = Util::getNumericQueryParameter($request->assigned_to_id);
		$issue->lookup_issue_component_id = Util::getNumericQueryParameter($request->lookup_issue_component_id);
		$issue->lookup_issue_category_id = Util::getNumericQueryParameter($request->lookup_issue_category_id);
		$issue->lookup_issue_severity_id = Util::getNumericQueryParameter($request->lookup_issue_severity_id);
		$issue->issue_status_id = Util::getNumericQueryParameter($request->issue_status_id);
		$issue->description = Util::getQueryParameter($request->description);
		$issue->updated_by_id = $user->id;
		$issue->save();
		return redirect()->action('IssueController@getViewIssue', ['issue_Id' => $issue->id])
			->with(['message' => 'Issue updated']);
	}
	
	/**
	 * Load the page to view an issue
	 *
	 * @param Request $request
	 * @param unknown $issue_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewIssue(Request $request, $issue_id)
	{
		$issue = Issue::find($issue_id);
		return view('issue.view-issue', [
				'issue' => $issue
		]);
	}
}
