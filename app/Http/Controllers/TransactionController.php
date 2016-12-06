<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\Transaction;
use jericho\PropertyFlip;
use jericho\Util\Util;
use jericho\Util\TabConstants;
use jericho\Lookup\AccountLookupRetriever;
use jericho\Lookup\TransactionTypeLookupRetriever;
use jericho\Http\Controllers\Auth\AuthUserRetriever;
use jericho\Validation\UpdateObjectValidator;
use jericho\Validation\ViewObjectValidator;

/**
 * This class is a controller for performing CRUD operations on transactions
 *
 * @author Jaco Koekemoer
 * Date: 2016-09-23
 *
 */
class TransactionController extends Controller
{
	/**
	 * Load page to add an transaction
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddTransaction(Request $request, $property_flip_id)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::TRANSACTIONS_TAB);
		$accounts = (new AccountLookupRetriever())->execute();
		$lookup_transaction_types = (new TransactionTypeLookupRetriever())->execute();
		return view('transaction.add-transaction', [
			'property_flip_id' => $property_flip_id,
			'accounts' => $accounts,
			'lookup_transaction_types' => $lookup_transaction_types
		]);
	}
	
	/**
	 * Add an transaction
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddTransaction(Request $request)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::TRANSACTIONS_TAB);
		
		$validator = Validator::make($request->all(), [
				'effective_date' => 'required',
				'account_id' => 'required|not_in:-1',
				'transaction_type_id' => 'required|not_in:-1',
				'debit_amount' => 'required_without:credit_amount',
				'credit_amount' => 'required_without:debit_amount'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('add-transaction', ['property_flip_id' => $request->property_flip_id])
				->withErrors($validator)
				->withInput();
		}
		
		$user = (new AuthUserRetriever())->retrieveUser();
		$transaction = new Transaction();
		$transaction->effective_date = Util::getDateQueryParameter($request->effective_date);
		$transaction->description = Util::getQueryParameter($request->description);
		$transaction->reference = Util::getQueryParameter($request->reference);
		$transaction->account_id = Util::getQueryParameter($request->account_id);
		$transaction->transaction_type_id = Util::getQueryParameter($request->transaction_type_id);
		$transaction->debit_amount = Util::processCurrencyValue($request->debit_amount);
		$transaction->credit_amount = Util::processCurrencyValue($request->credit_amount);
		$transaction->created_by_id = $user->id;
		$property_flip = PropertyFlip::find($request->property_flip_id);
		$property_flip->transactions()->save($transaction);
		
		return redirect()->action('PropertyFlipController@getViewPropertyFlip', ['property_flip_id' => $property_flip->id])
			->with(['message' => 'Transaction added']);
	}
	
	/**
	 * Load page to update an transaction
	 *
	 * @param Request $request
	 * @param unknown $transaction_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdateTransaction(Request $request, $transaction_id)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::TRANSACTIONS_TAB);
		$transaction = Transaction::find($transaction_id);
		(new UpdateObjectValidator())->validate($transaction, 'transaction', $transaction_id);
		$accounts = $accounts = (new AccountLookupRetriever())->execute();
		$lookup_transaction_types = (new TransactionTypeLookupRetriever())->execute();
		return view('transaction.update-transaction', [
			'transaction' => $transaction,
			'accounts' => $accounts,
			'lookup_transaction_types' => $lookup_transaction_types
		]);
	}
	
	/**
	 * Update an transaction
	 *
	 * @param Request $request
	 * @param unknown $transaction_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdateTransaction(Request $request, $transaction_id)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::TRANSACTIONS_TAB);
		$validator = Validator::make($request->all(), [
				'effective_date' => 'required',
				'account_id' => 'required|not_in:-1',
				'transaction_type_id' => 'required|not_in:-1',
				'debit_amount' => 'required_without:credit_amount',
				'credit_amount' => 'required_without:debit_amount'
		]);
		
		if ($validator->fails()) {
			return redirect()
			->route('update-transaction', ['transaction_id' => $transaction_id])
			->withErrors($validator)
			->withInput();
		}
		
		$user = (new AuthUserRetriever())->retrieveUser();
		$transaction = Transaction::find($transaction_id);
		(new UpdateObjectValidator())->validate($transaction, 'transaction', $transaction_id);
		$transaction->effective_date = Util::getDateQueryParameter($request->effective_date);
		$transaction->description = Util::getQueryParameter($request->description);
		$transaction->reference = Util::getQueryParameter($request->reference);
		$transaction->account_id = Util::getQueryParameter($request->account_id);
		$transaction->transaction_type_id = Util::getQueryParameter($request->transaction_type_id);
		$transaction->debit_amount = Util::processCurrencyValue($request->debit_amount);
		$transaction->credit_amount = Util::processCurrencyValue($request->credit_amount);
		$transaction->updated_by_id = $user->id;
		$transaction->save();
		return redirect()->action('PropertyFlipController@getViewPropertyFlip', ['property_flip_id' => $transaction->property_flip->id])
			->with(['message' => 'Transaction updated']);
	}
	
	/**
	 * Load the page to view an transaction
	 *
	 * @param Request $request
	 * @param unknown $transaction_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewTransaction(Request $request, $transaction_id)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::TRANSACTIONS_TAB);
		$transaction = Transaction::find($transaction_id);
		(new ViewObjectValidator())->validate($transaction, 'transaction', $transaction_id);
		return view('transaction.view-transaction', [
				'transaction' => $transaction
		]);
	}
}
