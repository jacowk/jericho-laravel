<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\LookupTransactionType;
use jericho\Util\Util;
use jericho\Http\Controllers\Auth\AuthUserRetriever;

/**
 * This class is a controller for performing CRUD operations on marital statuses
 *
 * @author Jaco Koekemoer
 * Date: 2016-09-23
 *
 */
class TransactionTypeController extends Controller
{
	/**
	 * Load search page
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getSearchTransactionType()
	{
		return view('transaction-type.search-transaction-type', [
			'description' => null
		]);
	}
	
	/**
	 * Search for transaction type
	 *
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function postDoSearchTransactionType(Request $request)
	{
		$user = (new AuthUserRetriever())->retrieveUser();
		$description = null;
		if (Util::isValidRequestVariable($request->description))
		{
			$description = $request->description;
			$transaction_types = LookupTransactionType::where('description', 'like', '%' . $description . '%')
									->orderBy('description', 'asc')
									->paginate($user->pagination_size);
		}
		else
		{
			$transaction_types = LookupTransactionType::orderBy('description', 'asc')->paginate($user->pagination_size);
		}
		return view('transaction-type.search-transaction-type', [
			'transaction_types' => $transaction_types,
			'description' => $description
		]);
	}
	
	/**
	 * Load page to add an transaction type
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddTransactionType()
	{
		return view('transaction-type.add-transaction-type');
	}
	
	/**
	 * Add a transaction type
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddTransactionType(Request $request)
	{
		$validator = Validator::make($request->all(), [
				'description' => 'required|unique:lookup_transaction_types'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('add-transaction-type')
				->withErrors($validator)
				->withInput();
		}
		$user = (new AuthUserRetriever())->retrieveUser();
		$transaction_type = new LookupTransactionType();
		$transaction_type->description = Util::getQueryParameter($request->description);
		$transaction_type->created_by_id = $user->id;
		$transaction_type->save();
		return redirect()->action('TransactionTypeController@getViewTransactionType', ['transaction_type_Id' => $transaction_type->id])
			->with(['message' => 'Transaction Type saved']);
	}
	
	/**
	 * Load page to update a transaction type
	 *
	 * @param Request $request
	 * @param unknown $transaction_type_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdateTransactionType(Request $request, $transaction_type_id)
	{
		$transaction_type = LookupTransactionType::find($transaction_type_id);
		return view('transaction-type.update-transaction-type', ['transaction_type' => $transaction_type]);
	}
	
	/**
	 * Update an transaction type
	 *
	 * @param Request $request
	 * @param unknown $transaction_type_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdateTransactionType(Request $request, $transaction_type_id)
	{
		$validator = Validator::make($request->all(), [
				'description' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('update-transaction-type', ['transaction_type_id' => $transaction_type_id])
				->withErrors($validator)
				->withInput();
		}
		$user = (new AuthUserRetriever())->retrieveUser();
		$transaction_type = LookupTransactionType::find($transaction_type_id);
		$transaction_type->description = Util::getQueryParameter($request->description);
		$transaction_type->updated_by_id = $user->id;
		$transaction_type->save();
		return redirect()->action('TransactionTypeController@getViewTransactionType', ['transaction_type_Id' => $transaction_type->id])
		->with(['message' => 'Transaction Type updated']);
	}
	
	/**
	 * Load the page to view an transaction type
	 *
	 * @param Request $request
	 * @param unknown $transaction_type_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewTransactionType(Request $request, $transaction_type_id)
	{
		$transaction_type = LookupTransactionType::find($transaction_type_id);
		return view('transaction-type.view-transaction-type', [
				'transaction_type' => $transaction_type
		]);
	}
}
