<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\ContractorService;
use jericho\Contractor;
use jericho\Util\Util;
use jericho\Lookup\ContractorTypeLookupRetriever;

/**
 * This class is a controller for performing CRUD operations on contractor services
 *
 * @author Jaco Koekemoer
 * Date: 2016-09-28
 *
 */
class ContractorServiceController extends Controller
{
	/**
	 * Load page to add a contractor service
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddContractorService(Request $request, $contractor_id)
	{
		$contractor_types = (new ContractorTypeLookupRetriever())->execute();
		return view('contractor-service.add-contractor-service', [
			'contractor_id' => $contractor_id,
			'contractor_types' => $contractor_types
		]);
	}
	
	/**
	 * Add a contractor service
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddContractorService(Request $request)
	{
		$validator = Validator::make($request->all(), [
				'service_description' => 'required',
				'contractor_type_id' => 'required|not_in:-1',
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('add-contractor-service', [
						'contractor_id' => $request->contractor_id,
				])
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$contractor_service = new ContractorService();
		$contractor_service->service_description = Util::getQueryParameter($request->service_description);
		$contractor_service->contractor_type_id = Util::getNumericQueryParameter($request->contractor_type_id);
		$contractor_service->contractor_id = Util::getQueryParameter($request->contractor_id);
		$contractor_service->created_by_id = $user->id;
		
		$contractor = Contractor::find($request->contractor_id);
		$contractor->contractor_services()->save($contractor_service);
		
		return redirect()->action('ContractorController@getViewContractor', ['contractor_id' => $contractor->id])
			->with(['message' => 'ContractorService added']);
	}
	
	/**
	 * Load page to update a contractor service
	 *
	 * @param Request $request
	 * @param unknown $contractor_service_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdateContractorService(Request $request, $contractor_service_id)
	{
		$contractor_service = ContractorService::find($contractor_service_id);
		$contractor_types = (new ContractorTypeLookupRetriever())->execute();
		return view('contractor-service.update-contractor-service', [
			'contractor_service' => $contractor_service,
			'contractor_types' => $contractor_types
		]);
	}
	
	/**
	 * Update a contractor service
	 *
	 * @param Request $request
	 * @param unknown $contractor_service_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdateContractorService(Request $request, $contractor_service_id)
	{
		$validator = Validator::make($request->all(), [
				'service_description' => 'required',
				'contractor_type_id' => 'required|not_in:-1',
		]);
		
		if ($validator->fails()) {
			$contractor_types = (new ContractorTypeLookupRetriever())->execute();
			$contractor_service = ContractorService::find($contractor_service_id);
			return redirect()
				->route('update-contractor-service', [
						'contractor_service_id' => $contractor_service_id])
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$contractor_service = ContractorService::find($contractor_service_id);
		$contractor_service->service_description = Util::getQueryParameter($request->service_description);
		$contractor_service->contractor_type_id = Util::getNumericQueryParameter($request->contractor_type_id);
		$contractor_service->updated_by_id = $user->id;
		$contractor_service->save();
		return redirect()->action('ContractorController@getViewContractor', [
			'contractor_id' => $contractor_service->contractor->id
		])
			->with(['message' => 'Contractor Service updated']);
	}
	
	/**
	 * Load the page to view a contractor service
	 *
	 * @param Request $request
	 * @param unknown $contractor_service_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewContractorService(Request $request, $contractor_service_id)
	{
		$contractor_service = ContractorService::find($contractor_service_id);
		return view('contractor-service.view-contractor-service', [
				'contractor_service' => $contractor_service
		]);
	}
}
