<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\LookupContractorType;
use jericho\Util\Util;

/**
 * This class is a controller for performing CRUD operations on contractor types
 *
 * @author Jaco Koekemoer
 * Date: 2016-09-28
 *
 */
class ContractorTypeController extends Controller
{
	/**
	 * Load search page
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getSearchContractorType()
	{
		return view('contractor-type.search-contractor-type', [
			'description' => null
		]);
	}
	
	/**
	 * Search for contractor type
	 *
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function postDoSearchContractorType(Request $request)
	{
		$user = Auth::user();
		$description = null;
		if (Util::isValidRequestVariable($request->description))
		{
			$description = $request->description;
			$contractor_types = LookupContractorType::where('description', 'like', '%' . $description . '%')
									->orderBy('description', 'asc')
									->paginate($user->pagination_size);
		}
		else
		{
			$contractor_types = LookupContractorType::orderBy('description', 'asc')->paginate($user->pagination_size);
		}
		return view('contractor-type.search-contractor-type', [
			'contractor_types' => $contractor_types,
			'description' => $description
		]);
	}
	
	/**
	 * Load page to add an contractor type
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddContractorType()
	{
		return view('contractor-type.add-contractor-type');
	}
	
	/**
	 * Add a contractor type
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddContractorType(Request $request)
	{
// 		$this->validate($request, [
// 				'description' => 'required|unique:lookup_contractor_types'
// 		]);
		$validator = Validator::make($request->all(), [
				'description' => 'required|unique:lookup_contractor_types'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('add-contractor-type')
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$contractor_type = new LookupContractorType();
		$contractor_type->description = Util::getQueryParameter($request->description);
		$contractor_type->created_by_id = $user->id;
		$contractor_type->save();
		return redirect()->action('ContractorTypeController@getViewContractorType', ['contractor_type_Id' => $contractor_type->id])
			->with(['message' => 'Contractor Type saved']);
	}
	
	/**
	 * Load page to update a contractor type
	 *
	 * @param Request $request
	 * @param unknown $contractor_type_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdateContractorType(Request $request, $contractor_type_id)
	{
		$contractor_type = LookupContractorType::find($contractor_type_id);
		return view('contractor-type.update-contractor-type', ['contractor_type' => $contractor_type]);
	}
	
	/**
	 * Update an contractor type
	 *
	 * @param Request $request
	 * @param unknown $contractor_type_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdateContractorType(Request $request, $contractor_type_id)
	{
// 		$this->validate($request, [
// 				'description' => 'required'
// 		]);
		$validator = Validator::make($request->all(), [
				'description' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('update-contractor-type', ['contractor_type_id' => $contractor_type_id])
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$contractor_type = LookupContractorType::find($contractor_type_id);
		$contractor_type->description = Util::getQueryParameter($request->description);
		$contractor_type->updated_by_id = $user->id;
		$contractor_type->save();
		return redirect()->action('ContractorTypeController@getViewContractorType', ['contractor_type_Id' => $contractor_type->id])
		->with(['message' => 'Contractor Type updated']);
	}
	
	/**
	 * Load the page to view an contractor type
	 *
	 * @param Request $request
	 * @param unknown $contractor_type_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewContractorType(Request $request, $contractor_type_id)
	{
		$contractor_type = LookupContractorType::find($contractor_type_id);
		return view('contractor-type.view-contractor-type', [
				'contractor_type' => $contractor_type
		]);
	}
}
