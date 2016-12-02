<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\Util\Util;
use jericho\Account;
use jericho\Http\Controllers\Auth\AuthUserRetriever;

/**
 * This class is a controller for performing CRUD operations on accounts
 *
 * @author Jaco Koekemoer
 * Date: 2016-09-19
 *
 */
class AccountController extends Controller
{
	/**
	 * Load search page
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getSearchAccount()
	{
		return view('account.search-account', [
			'name' => null
		]);
	}
	
	/**
	 * Search for accounts
	 *
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function postDoSearchAccount(Request $request)
	{
		$user = (new AuthUserRetriever())->retrieveUser();
		$name = null;
		if (Util::isValidRequestVariable($request->name))
		{
			$name = $request->name;
			$accounts = Account::where('name', 'like', '%' . $name . '%')
							->orderBy('name', 'asc')
							->paginate($user->pagination_size);
		}
		else
		{
			$accounts = Account::orderBy('name', 'asc')
							->paginate($user->pagination_size);
		}
		return view('account.search-account', [
				'accounts' => $accounts,
				'name' => $name
		]);
	}
	
	/**
	 * Load page to add an account
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddAccount()
	{
		return view('account.add-account');
	}
	
	/**
	 * Add an account
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddAccount(Request $request)
	{
		$validator = Validator::make($request->all(), [
				'name' => 'required|unique:accounts'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('add-account')
				->withErrors($validator)
				->withInput();
		}
		
		$user = (new AuthUserRetriever())->retrieveUser();
		$account = new Account();
		$account->name = Util::getQueryParameter($request->name);
		$account->created_by_id = $user->id;
		$account->save();
		return redirect()->action('AccountController@getViewAccount', ['account_Id' => $account->id])
		->with(['message' => 'Account saved']);
	}
	
	/**
	 * Load page to update an account
	 *
	 * @param Request $request
	 * @param unknown $account_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdateAccount(Request $request, $account_id)
	{
		$account = Account::find($account_id);
		return view('account.update-account', ['account' => $account]);
	}
	
	/**
	 * Update an account
	 *
	 * @param Request $request
	 * @param unknown $account_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdateAccount(Request $request, $account_id)
	{
		$validator = Validator::make($request->all(), [
				'name' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('update-account', ['account_id' => $account_id])
				->withErrors($validator)
				->withInput();
		}
		$user = (new AuthUserRetriever())->retrieveUser();
		$account = Account::find($account_id);
		$account->name = Util::getQueryParameter($request->name);
		$account->updated_by_id = $user->id;
		$account->save();
		return redirect()->action('AccountController@getViewAccount', ['account_Id' => $account->id])
		->with(['message' => 'Account updated']);
	}
	
	/**
	 * Load the page to view an account
	 *
	 * @param Request $request
	 * @param unknown $account_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewAccount(Request $request, $account_id)
	{
		$account = Account::find($account_id);
		return view('account.view-account', [
				'account' => $account
		]);
	}
}
