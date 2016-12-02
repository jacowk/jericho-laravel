<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\Bank;
use jericho\Util\ModelConstants;
use jericho\Util\Util;
use jericho\Http\Controllers\Auth\AuthUserRetriever;

/**
 * This class is a controller for performing CRUD operations on banks
 * 
 * @author Jaco Koekemoer
 * Date: 2016-09-12
 *
 */
class BankController extends Controller
{
	/**
	 * Load search page
	 * 
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
    public function getSearchBank()
    {
    	return view('bank.search-bank', [
			'name' => null
		]);
    }
    
    /**
     * Search for banks
     * 
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function postDoSearchBank(Request $request)
    {
    	$user = (new AuthUserRetriever())->retrieveUser();
    	$name = null;
    	if (Util::isValidRequestVariable($request->name))
    	{
    		$name = $request->name;
    		$banks = Bank::where('name', 'like', '%' . $name . '%')->orderBy('name', 'asc')->paginate($user->pagination_size);
    	}
    	else 
    	{
    		$banks = Bank::orderBy('name', 'asc')->paginate($user->pagination_size);
    	}
    	return view('bank.search-bank', [
    		'banks' => $banks,
    		'name' => $name
    	]);
    }
    
    /**
     * Load page to add an bank
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getAddBank()
    {
    	return view('bank.add-bank');
    }
    
    /**
     * Add an bank
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDoAddBank(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    			'name' => 'required|unique:banks'
    	]);
    	
    	if ($validator->fails()) {
    		return redirect()
	    		->route('add-bank')
	    		->withErrors($validator)
	    		->withInput();
    	}
    	$user = (new AuthUserRetriever())->retrieveUser();
    	$bank = new Bank();
    	$bank->name = Util::getQueryParameter($request->name);
    	$bank->created_by_id = $user->id;
    	$bank->save();
    	return redirect()->action('BankController@getViewBank', ['bank_Id' => $bank->id])
    	 		->with(['message' => 'Bank saved']);
    }
    
    /**
     * Load page to update an bank
     * 
     * @param Request $request
     * @param unknown $bank_id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getUpdateBank(Request $request, $bank_id)
    {
    	$bank = Bank::find($bank_id);
    	return view('bank.update-bank', ['bank' => $bank]);
    }
    
    /**
     * Update an bank
     * 
     * @param Request $request
     * @param unknown $bank_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDoUpdateBank(Request $request, $bank_id)
    {
    	$validator = Validator::make($request->all(), [
    			'name' => 'required'
    	]);
    	
    	if ($validator->fails()) {
    		return redirect()
	    		->route('update-bank', ['bank_id' => $bank_id])
	    		->withErrors($validator)
	    		->withInput();
    	}
    	$user = (new AuthUserRetriever())->retrieveUser();
    	$bank = Bank::find($bank_id);
    	$bank->name = Util::getQueryParameter($request->name);
    	$bank->updated_by_id = $user->id;
    	$bank->save();
    	return redirect()->action('BankController@getViewBank', ['bank_Id' => $bank->id])
    	->with(['message' => 'Bank updated']);
    }
    
    /**
     * Load the page to view an bank
     * 
     * @param Request $request
     * @param unknown $bank_id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getViewBank(Request $request, $bank_id)
    {
    	$bank = Bank::find($bank_id);
    	$contacts = $bank->contacts()->get();
    	return view('bank.view-bank', [
    			'bank' => $bank,
    			'contacts' => $contacts,
    			'model_name' => ModelConstants::BANK_MODEL_NAME,
    			'model_id'=> $bank_id
    	]);
    }
}
