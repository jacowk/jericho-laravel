<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\EstateAgent;
use jericho\User;
use jericho\Util\ModelConstants;
use jericho\Util\Util;

/**
 * This class is a controller for performing CRUD operations on estate agents
 * 
 * @author Jaco Koekemoer
 * Date: 2016-09-12
 *
 */
class EstateAgentController extends Controller
{
	/**
	 * Load search page
	 * 
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
    public function getSearchEstateAgent()
    {
    	return view('estate-agent.search-estate-agent', [
    		'name' => null
    	]);
    }
    
    /**
     * Search for estate agents
     * 
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function postDoSearchEstateAgent(Request $request)
    {
    	$user = Auth::user();
    	$name = null;
    	if (Util::isValidRequestVariable($request->name))
    	{
    		$name = $request->name;
    		$estate_agents = EstateAgent::where('name', 'like', '%' . $name . '%')->orderBy('name', 'asc')->paginate($user->pagination_size);
    	}
    	else 
    	{
    		$estate_agents = EstateAgent::orderBy('name', 'asc')->paginate($user->pagination_size);
    	}
    	return view('estate-agent.search-estate-agent', [
    		'estate_agents' => $estate_agents,
    		'name' => $name
    	]);
    }
    
    /**
     * Load page to add an estate agents
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getAddEstateAgent()
    {
    	return view('estate-agent.add-estate-agent');
    }
    
    /**
     * Add an estate agent
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDoAddEstateAgent(Request $request)
    {
//     	$this->validate($request, [
//     	 	'name' => 'required|unique:estate_agents'
//     	]);
    	$validator = Validator::make($request->all(), [
    			'name' => 'required|unique:estate_agents'
    	]);
    	
    	if ($validator->fails()) {
    		return redirect()
	    		->route('add-estate-agent')
	    		->withErrors($validator)
	    		->withInput();
    	}
    	$user = Auth::user();
    	$estate_agent = new EstateAgent();
    	$estate_agent->name = Util::getQueryParameter($request->name);
    	$estate_agent->created_by_id = $user->id;
    	$estate_agent->save();
    	return redirect()->action('EstateAgentController@getViewEstateAgent', ['estate_agent_id' => $estate_agent->id])
    	 		->with(['message' => 'Estate Agent saved']);
    }
    
    /**
     * Load page to update an estate agent
     * 
     * @param Request $request
     * @param unknown $estate_agent_id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getUpdateEstateAgent(Request $request, $estate_agent_id)
    {
    	$estate_agent = EstateAgent::find($estate_agent_id);
    	return view('estate-agent.update-estate-agent', ['estate_agent' => $estate_agent]);
    }
    
    /**
     * Update an estate agent
     * 
     * @param Request $request
     * @param unknown $estate_agent_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDoUpdateEstateAgent(Request $request, $estate_agent_id)
    {
//     	$this->validate($request, [
//     		'name' => 'required'
//     	]);
    	$validator = Validator::make($request->all(), [
    			'name' => 'required'
    	]);
    	
    	if ($validator->fails()) {
    		return redirect()
	    		->route('update-estate-agent', ['estate_agent_id' => $estate_agent_id])
	    		->withErrors($validator)
	    		->withInput();
    	}
    	$user = Auth::user();
    	$estate_agent = EstateAgent::find($estate_agent_id);
    	$estate_agent->name = Util::getQueryParameter($request->name);
    	$estate_agent->updated_by_id = $user->id;
    	$estate_agent->save();
    	return redirect()->action('EstateAgentController@getViewEstateAgent', ['estate_agent_id' => $estate_agent->id])
    		->with(['message' => 'Estate Agent updated']);
    }
    
    /**
     * Load the page to view an bank
     * 
     * @param Request $request
     * @param unknown $bank_id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getViewEstateAgent(Request $request, $estate_agent_id)
    {
    	$estate_agent = EstateAgent::find($estate_agent_id);
    	$contacts = $estate_agent->contacts()->get();
    	return view('estate-agent.view-estate-agent', [
    			'estate_agent' => $estate_agent,
    			'contacts' => $contacts,
    			'model_name' => ModelConstants::ESTATE_AGENT_MODEL_NAME,
    			'model_id'=> $estate_agent_id
    	]);
    }
}
