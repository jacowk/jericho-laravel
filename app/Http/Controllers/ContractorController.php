<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\Contractor;
use jericho\User;
use jericho\Util\ModelConstants;
use jericho\Util\Util;

/**
 * This class is a controller for performing CRUD operations on contractors
 * 
 * @author Jaco Koekemoer
 * Date: 2016-09-12
 *
 */
class ContractorController extends Controller
{
	/**
	 * Load search page
	 * 
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
    public function getSearchContractor()
    {
    	return view('contractor.search-contractor', [
    			'name' => null
    	]);
    }
    
    /**
     * Search for contractors
     * 
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function postDoSearchContractor(Request $request)
    {
    	$user = Auth::user();
    	$name = null;
    	if (Util::isValidRequestVariable($request->name))
    	{
    		$name = $request->name;
    		$contractors = Contractor::where('name', 'like', '%' . $name . '%')->orderBy('name', 'asc')->paginate($user->pagination_size);
    	}
    	else 
    	{
    		$contractors = Contractor::orderBy('name', 'asc')->paginate($user->pagination_size);
    	}
    	return view('contractor.search-contractor', [
    		'contractors' => $contractors,
    		'name' => $name
    	]);
    }
    
    /**
     * Load page to add an contractor
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getAddContractor()
    {
    	return view('contractor.add-contractor');
    }
    
    /**
     * Add an contractor
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDoAddContractor(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    			'name' => 'required|unique:contractors'
    	]);
    	
    	if ($validator->fails()) {
    		return redirect()
	    		->route('add-contractor')
	    		->withErrors($validator)
	    		->withInput();
    	}
    	$user = Auth::user();
    	$contractor = new Contractor();
    	$contractor->name = Util::getQueryParameter($request->name);
    	$contractor->created_by_id = $user->id;
    	$contractor->save();
    	return redirect()->action('ContractorController@getViewContractor', ['contractor_Id' => $contractor->id])
    	 		->with(['message' => 'Contractor saved']);
    }
    
    /**
     * Load page to update an contractor
     * 
     * @param Request $request
     * @param unknown $contractor_id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getUpdateContractor(Request $request, $contractor_id)
    {
    	$contractor = Contractor::find($contractor_id);
    	return view('contractor.update-contractor', ['contractor' => $contractor]);
    }
    
    /**
     * Update an contractor
     * 
     * @param Request $request
     * @param unknown $contractor_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDoUpdateContractor(Request $request, $contractor_id)
    {
    	$validator = Validator::make($request->all(), [
    			'name' => 'required'
    	]);
    	
    	if ($validator->fails()) {
    		return redirect()
	    		->route('update-contractor', ['contractor_id' => $contractor_id])
	    		->withErrors($validator)
	    		->withInput();
    	}
    	$user = Auth::user();
    	$contractor = Contractor::find($contractor_id);
    	$contractor->name = Util::getQueryParameter($request->name);
    	$contractor->updated_by_id = $user->id;
    	$contractor->save();
    	return redirect()->action('ContractorController@getViewContractor', ['contractor_Id' => $contractor->id])
    		->with(['message' => 'Contractor updated']);
    }
    
    /**
     * Load the page to view an contractor
     * 
     * @param Request $request
     * @param unknown $contractor_id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getViewContractor(Request $request, $contractor_id)
    {
    	$contractor = Contractor::find($contractor_id);
    	$contacts = $contractor->contacts()->get();
    	return view('contractor.view-contractor', [
    		'contractor' => $contractor, 
    		'contacts' => $contacts, 
    		'model_name' => ModelConstants::CONTRACTOR_MODEL_NAME,
    		'model_id'=> $contractor_id
    	]);
    }
}
