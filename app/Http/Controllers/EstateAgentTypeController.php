<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\LookupEstateAgentType;
use jericho\Util\Util;
use jericho\Http\Controllers\Auth\AuthUserRetriever;

/**
 * This class is a controller for performing CRUD operations on marital statuses
 *
 * @author Jaco Koekemoer
 * Date: 2016-09-23
 *
 */
class EstateAgentTypeController extends Controller
{
	/**
	 * Load search page
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getSearchEstateAgentType()
	{
		return view('estate-agent-type.search-estate-agent-type', [
			'description' => null
		]);
	}
	
	/**
	 * Search for estate agent type
	 *
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function postDoSearchEstateAgentType(Request $request)
	{
		$user = (new AuthUserRetriever())->retrieveUser();
		$description = null;
		if (Util::isValidRequestVariable($request->description))
		{
			$description = $request->description;
			$estate_agent_types = LookupEstateAgentType::where('description', 'like', '%' . $description . '%')
									->orderBy('description', 'asc')
									->paginate($user->pagination_size);
		}
		else
		{
			$estate_agent_types = LookupEstateAgentType::orderBy('description', 'asc')->paginate($user->pagination_size);
		}
		return view('estate-agent-type.search-estate-agent-type', [
			'estate_agent_types' => $estate_agent_types,
			'description' => $description
		]);
	}
	
	/**
	 * Load page to add an estate agent type
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddEstateAgentType()
	{
		return view('estate-agent-type.add-estate-agent-type');
	}
	
	/**
	 * Add a estate agent type
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddEstateAgentType(Request $request)
	{
		$validator = Validator::make($request->all(), [
				'description' => 'required|unique:lookup_estate_agent_types'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('add-estate-agent-type')
				->withErrors($validator)
				->withInput();
		}
		$user = (new AuthUserRetriever())->retrieveUser();
		$estate_agent_type = new LookupEstateAgentType();
		$estate_agent_type->description = Util::getQueryParameter($request->description);
		$estate_agent_type->created_by_id = $user->id;
		$estate_agent_type->save();
		return redirect()->action('EstateAgentTypeController@getViewEstateAgentType', ['estate_agent_type_Id' => $estate_agent_type->id])
			->with(['message' => 'Estate Agent Type saved']);
	}
	
	/**
	 * Load page to update a estate agent type
	 *
	 * @param Request $request
	 * @param unknown $estate_agent_type_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdateEstateAgentType(Request $request, $estate_agent_type_id)
	{
		$estate_agent_type = LookupEstateAgentType::find($estate_agent_type_id);
		return view('estate-agent-type.update-estate-agent-type', ['estate_agent_type' => $estate_agent_type]);
	}
	
	/**
	 * Update an estate agent type
	 *
	 * @param Request $request
	 * @param unknown $estate_agent_type_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdateEstateAgentType(Request $request, $estate_agent_type_id)
	{
		$validator = Validator::make($request->all(), [
				'description' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('update-estate-agent-type', ['estate_agent_type_id' => $estate_agent_type_id])
				->withErrors($validator)
				->withInput();
		}
		$user = (new AuthUserRetriever())->retrieveUser();
		$estate_agent_type = LookupEstateAgentType::find($estate_agent_type_id);
		$estate_agent_type->description = Util::getQueryParameter($request->description);
		$estate_agent_type->updated_by_id = $user->id;
		$estate_agent_type->save();
		return redirect()->action('EstateAgentTypeController@getViewEstateAgentType', ['estate_agent_type_Id' => $estate_agent_type->id])
		->with(['message' => 'Estate Agent Type updated']);
	}
	
	/**
	 * Load the page to view an estate agent type
	 *
	 * @param Request $request
	 * @param unknown $estate_agent_type_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewEstateAgentType(Request $request, $estate_agent_type_id)
	{
		$estate_agent_type = LookupEstateAgentType::find($estate_agent_type_id);
		return view('estate-agent-type.view-estate-agent-type', [
				'estate_agent_type' => $estate_agent_type
		]);
	}
}
