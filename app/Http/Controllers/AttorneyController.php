<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\Attorney;
use jericho\User;
use jericho\Util\ModelConstants;
use jericho\Util\Util;

/**
 * This class is a controller for performing CRUD operations on attorneys
 * 
 * @author Jaco Koekemoer
 * Date: 2016-09-09
 *
 */
class AttorneyController extends Controller
{
	/**
	 * Load search page
	 * 
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
    public function getSearchAttorney()
    {
    	return view('attorney.search-attorney');
    }
    
    /**
     * Search for attorneys
     * 
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function postDoSearchAttorney(Request $request)
    {
    	if (isset($request->name) && !is_null($request->name) && strlen($request->name) > 0)
    	{
    		$name = $request->name;
    		$attorneys = Attorney::where('name', 'like', '%' . $name . '%')->orderBy('name', 'asc')->get();
    	}
    	else 
    	{
    		$attorneys = Attorney::orderBy('name', 'asc')->get();
    	}
    	return view('attorney.search-attorney', ['attorneys' => $attorneys]);
    }
    
    /**
     * Load page to add an attorney
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getAddAttorney()
    {
    	return view('attorney.add-attorney');
    }
    
    /**
     * Add an attorney
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDoAddAttorney(Request $request)
    {
//     	$this->validate($request, [
//     	 	'name' => 'required|unique:attorneys'
//     	]);
    	$validator = Validator::make($request->all(), [
    			'name' => 'required|unique:attorneys'
    	]);
    	
    	if ($validator->fails()) {
    		return redirect()
    		->route('add-attorney')
    		->withErrors($validator)
    		->withInput();
    	}
    	$user = Auth::user();
    	$attorney = new Attorney();
    	$attorney->name = Util::getQueryParameter($request->name);
    	$attorney->created_by_id = $user->id;
    	$attorney->save();
    	return redirect()->action('AttorneyController@getViewAttorney', ['attorney_Id' => $attorney->id])
    	 		->with(['message' => 'Attorney saved']);
    }
    
    /**
     * Load page to update an attorney
     * 
     * @param Request $request
     * @param unknown $attorney_id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getUpdateAttorney(Request $request, $attorney_id)
    {
    	$attorney = Attorney::find($attorney_id);
    	return view('attorney.update-attorney', ['attorney' => $attorney]);
    }
    
    /**
     * Update an attorney
     * 
     * @param Request $request
     * @param unknown $attorney_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDoUpdateAttorney(Request $request, $attorney_id)
    {
//     	$this->validate($request, [
//     		'name' => 'required'
//     	]);
    	$validator = Validator::make($request->all(), [
    			'name' => 'required'
    	]);
    	 
    	if ($validator->fails()) {
    		return redirect()
	    		->route('update-attorney', ['attorney_id' => $attorney_id])
	    		->withErrors($validator)
	    		->withInput();
    	}
    	$user = Auth::user();
    	$attorney = Attorney::find($attorney_id);
    	$attorney->name = Util::getQueryParameter($request->name);
    	$attorney->updated_by_id = $user->id;
    	$attorney->save();
    	return redirect()->action('AttorneyController@getViewAttorney', ['attorney_Id' => $attorney->id])
    	->with(['message' => 'Attorney updated']);
    }
    
    /**
     * Load the page to view an attorney
     * 
     * @param Request $request
     * @param unknown $attorney_id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getViewAttorney(Request $request, $attorney_id)
    {
    	$attorney = Attorney::find($attorney_id);
    	$contacts = $attorney->contacts()->get();
    	return view('attorney.view-attorney', [
    		'attorney' => $attorney, 
    		'contacts' => $contacts, 
    		'model_name' => ModelConstants::ATTORNEY_MODEL_NAME,
    		'model_id'=> $attorney_id
    	]);
    }
}
