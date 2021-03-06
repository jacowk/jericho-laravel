<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\PropertyFlip;
use jericho\Contact;
use jericho\Util\Util;
use jericho\Contractor;
use Carbon\Carbon;
use DB;
use jericho\Util\TabConstants;
use jericho\Audits\LinkContractorPropertyFlipAuditor;
use jericho\Audits\DeleteContractorPropertyFlipAuditor;
use jericho\Lookup\ContractorLookupRetriever;
use jericho\Lookup\ContactContractorAjaxLookupRetriever;
use jericho\Lookup\ContractorServiceTypeAjaxLookupRetriever;
use jericho\Http\Controllers\Auth\AuthUserRetriever;

/**
 * This class is a controller for linking the contacts of contractors to property flips
 *
 * @author Jaco Koekemoer
 * Date: 2016-09-27
 *
 */
class ContractorPropertyFlipController extends Controller
{
	/**
	 * Post link contractor
	 *
	 * @param Request $request
	 * @param unknown $property_flip_id
	 */
	public function postLinkContactContractor(Request $request)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::CONTRACTORS_TAB);
		$property_flip_id = Util::getQueryParameter($request->property_flip_id);
		$contractors = (new ContractorLookupRetriever())->execute();
		$lookup_contractor_types = array();
		$lookup_contractor_types['-1'] = "Select Contractor Type";
		$contacts = array();
		$contacts['-1'] = "Select Contractor Contact";
		return view ('property-flip.link-contractor-contact', [
				'contractors' => $contractors,
				'property_flip_id' => $property_flip_id,
				'contacts' => $contacts,
				'lookup_contractor_types' => $lookup_contractor_types
		]);
	}
	
	/**
	 * Do the actual linking of the contractor contact to the property flip
	 *
	 * @param Request $request
	 */
	public function postDoLinkContactContractor(Request $request)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::CONTRACTORS_TAB);
		$validator = Validator::make($request->all(), [
				'property_flip_id' => 'required',
				'contractor_id' => 'required|not_in:-1',
				'contact_id' => 'required|not_in:-1',
				'lookup_contractor_type_id' => 'required|not_in:-1'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('link-contractor-contact', ['property_flip_id' => $request->property_flip_id])
				->withErrors($validator)
				->withInput()
				->with('property_flip_id', $request->property_flip_id);
		}
		$user = (new AuthUserRetriever())->retrieveUser();
		$property_flip_id = Util::getNumericQueryParameter($request->property_flip_id);
		$contractor_id = Util::getNumericQueryParameter($request->contractor_id);
		$contact_id = Util::getNumericQueryParameter($request->contact_id);
		$lookup_contractor_type_id = Util::getNumericQueryParameter($request->lookup_contractor_type_id);
		$property_flip = PropertyFlip::find($property_flip_id);
		$contractor = Contractor::find($contractor_id);
		$contact = Contact::find($contact_id);
		if (!$this->isDuplicate($property_flip_id, $contact_id, $lookup_contractor_type_id))
		{
			$property_flip->contractors()->attach($contact, [
					'lookup_contractor_type_id' => $lookup_contractor_type_id,
					'created_by_id' => $user->id,
					'created_at'=> new Carbon
			]);
			
			/* Auditing */
			(new LinkContractorPropertyFlipAuditor($request, $property_flip, $contractor, $contact, $lookup_contractor_type_id, $user))->log();
			
			return redirect()->action('PropertyFlipController@getViewPropertyFlip', ['property_flip_Id' => $property_flip->id])
				->with(['message' => 'Contractor Contact linked']);
		}
		return redirect()->action('PropertyFlipController@getViewPropertyFlip', ['property_flip_Id' => $property_flip->id]);
	}
	
	/**
	 * Validate if the contractor contact was not already added for the property flip
	 * 
	 * @param unknown $property_flip
	 * @param unknown $contact_id
	 * @return boolean
	 */
	private function isDuplicate($property_flip_id, $contact_id, $lookup_contractor_type_id)
	{
		$contractor_contacts = DB::table('contractor_property_flip')
			->where('contact_id', '=', $contact_id)
			->where('property_flip_id', '=', $property_flip_id)
			->where('lookup_contractor_type_id', '=', $lookup_contractor_type_id)
			->select('contractor_property_flip.contact_id')
			->get();
		if (count($contractor_contacts) >= 1)
		{
			return true;
		}
		return false;
	}
	
	/**
	 * Get the contacts for the selected contractors via ajax
	 *
	 * @param Request $request
	 * @return string
	 */
	public function postAjaxContactContractors(Request $request)
	{
		$contractor_id = Util::getQueryParameter($request->contractor_id);
		$contractor_contacts = (new ContactContractorAjaxLookupRetriever($contractor_id))->execute();
		return json_encode($contractor_contacts);
	}
	
	/**
	 * Get the contractor types for the selected contractors via ajax
	 *
	 * @param Request $request
	 * @return string
	 */
	public function postAjaxContactContractorTypes(Request $request)
	{
		$contractor_id = Util::getQueryParameter($request->contractor_id);
		$contractor_contact_types = (new ContractorServiceTypeAjaxLookupRetriever($contractor_id))->execute();
		return json_encode($contractor_contact_types);
	}
	
	/**
	 * Do the actual linking of the contractor contact to the property flip
	 *
	 * @param Request $request
	 */
	public function postDoLinkContactContractorDelete(Request $request)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::CONTRACTORS_TAB);
		$user = (new AuthUserRetriever())->retrieveUser();
		$property_flip_id = Util::getNumericQueryParameter($request->property_flip_id);
		$contact_id = Util::getNumericQueryParameter($request->contact_id);
		$lookup_contractor_type_id = Util::getNumericQueryParameter($request->lookup_contractor_type_id);
		$property_flip = PropertyFlip::find($property_flip_id);
		$contact = Contact::find($contact_id);
		DB::table('contractor_property_flip')
			->where('contact_id', '=', $contact_id)
			->where('property_flip_id', '=', $property_flip_id)
			->where('lookup_contractor_type_id', '=', $lookup_contractor_type_id)
			->limit(1)
			->delete();
		
		/* Auditing */
		(new DeleteContractorPropertyFlipAuditor($request, $property_flip, $contact, $lookup_contractor_type_id, $user))->log();
			
		return redirect()->action('PropertyFlipController@getViewPropertyFlip', ['property_flip_Id' => $property_flip->id])
			->with(['message' => 'Contractor Contact removed from Property Flip']);
	}
}
