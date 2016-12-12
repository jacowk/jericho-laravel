<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\LookupLeadType;
use jericho\Util\Util;
use jericho\Http\Controllers\Auth\AuthUserRetriever;
use jericho\Validation\UpdateObjectValidator;
use jericho\Validation\ViewObjectValidator;

/**
 * This class is a controller for performing CRUD operations on lead types
 *
 * @author Jaco Koekemoer
 * Date: 2016-12-12
 *
 */
class LeadTypeController extends Controller
{
	/**
	 * Load search page
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getSearchLeadType()
	{
		return view('lead-type.search-lead-type', [
				'description' => null
		]);
	}
	
	/**
	 * Search for lead type
	 *
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function postDoSearchLeadType(Request $request)
	{
		$user = (new AuthUserRetriever())->retrieveUser();
		$description = null;
		if (Util::isValidRequestVariable($request->description))
		{
			$description = $request->description;
			$lead_types = LookupLeadType::where('description', 'like', '%' . $description . '%')
			->orderBy('description', 'asc')
			->paginate($user->pagination_size);
		}
		else
		{
			$lead_types = LookupLeadType::orderBy('description', 'asc')->paginate($user->pagination_size);
		}
		return view('lead-type.search-lead-type', [
				'lead_types' => $lead_types,
				'description' => $description
		]);
	}
	
	/**
	 * Load page to add an lead type
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddLeadType()
	{
		return view('lead-type.add-lead-type');
	}
	
	/**
	 * Add a lead type
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddLeadType(Request $request)
	{
		$validator = Validator::make($request->all(), [
				'description' => 'required|unique:lookup_lead_types'
		]);
	
		if ($validator->fails()) {
			return redirect()
			->route('add-lead-type')
			->withErrors($validator)
			->withInput();
		}
		$user = (new AuthUserRetriever())->retrieveUser();
		$lead_type = new LookupLeadType();
		$lead_type->description = Util::getQueryParameter($request->description);
		$lead_type->created_by_id = $user->id;
		$lead_type->save();
		return redirect()->action('LeadTypeController@getViewLeadType', ['lead_type_Id' => $lead_type->id])
		->with(['message' => 'Lead Type saved']);
	}
	
	/**
	 * Load page to update a lead type
	 *
	 * @param Request $request
	 * @param unknown $lead_type_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdateLeadType(Request $request, $lead_type_id)
	{
		$lead_type = LookupLeadType::find($lead_type_id);
		(new UpdateObjectValidator())->validate($lead_type, 'lead type', $lead_type_id);
		return view('lead-type.update-lead-type', ['lead_type' => $lead_type]);
	}
	
	/**
	 * Update an lead type
	 *
	 * @param Request $request
	 * @param unknown $lead_type_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdateLeadType(Request $request, $lead_type_id)
	{
		$validator = Validator::make($request->all(), [
				'description' => 'required'
		]);
	
		if ($validator->fails()) {
			return redirect()
			->route('update-lead-type', ['lead_type_id' => $lead_type_id])
			->withErrors($validator)
			->withInput();
		}
		$user = (new AuthUserRetriever())->retrieveUser();
		$lead_type = LookupLeadType::find($lead_type_id);
		(new UpdateObjectValidator())->validate($lead_type, 'lead type', $lead_type_id);
		$lead_type->description = Util::getQueryParameter($request->description);
		$lead_type->updated_by_id = $user->id;
		$lead_type->save();
		return redirect()->action('LeadTypeController@getViewLeadType', ['lead_type_Id' => $lead_type->id])
		->with(['message' => 'Lead Type updated']);
	}
	
	/**
	 * Load the page to view an lead type
	 *
	 * @param Request $request
	 * @param unknown $lead_type_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewLeadType(Request $request, $lead_type_id)
	{
		$lead_type = LookupLeadType::find($lead_type_id);
		(new ViewObjectValidator())->validate($lead_type, 'lead type', $lead_type_id);
		return view('lead-type.view-lead-type', [
				'lead_type' => $lead_type
		]);
	}
}
