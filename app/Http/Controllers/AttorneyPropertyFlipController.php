<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\PropertyFlip;
use jericho\Contact;
use jericho\Util\Util;
use jericho\Util\LookupUtil;
use jericho\Attorney;
use Carbon\Carbon;
use jericho\LookupAttorneyType;
use DB;
use jericho\Util\TabConstants;
use jericho\Audits\LinkAttorneyPropertyFlipAuditor;
use jericho\Audits\DeleteAttorneyPropertyFlipAuditor;

/**
 * This class is a controller for performing CRUD operations on property flips
 *
 * @author Jaco Koekemoer
 * Date: 2016-09-27
 *
 */
class AttorneyPropertyFlipController extends Controller
{
	/**
	 * Post link attorney
	 *
	 * @param Request $request
	 * @param unknown $property_flip_id
	 */
	public function postLinkAttorneyContact(Request $request)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::ATTORNEYS_TAB);
		$property_flip_id = Util::getQueryParameter($request->property_flip_id);
		$attorneys = LookupUtil::retrieveAttorneys();
		$lookup_attorney_types = LookupUtil::retrieveLookupAttorneyTypes();
		$contacts = array();
		$contacts['-1'] = "Select Attorney Contact";
		return view ('property-flip.link-attorney-contact', [
				'attorneys' => $attorneys,
				'property_flip_id' => $property_flip_id,
				'contacts' => $contacts,
				'lookup_attorney_types' => $lookup_attorney_types
		]);
	}
	
	/**
	 * Do the actual linking of the attorney contact to the property flip
	 *
	 * @param Request $request
	 */
	public function postDoLinkAttorneyContact(Request $request)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::ATTORNEYS_TAB);
		
		$validator = Validator::make($request->all(), [
				'property_flip_id' => 'required',
				'attorney_id' => 'required|not_in:-1',
				'contact_id' => 'required|not_in:-1',
				'lookup_attorney_type_id' => 'required|not_in:-1'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('link-attorney-contact', ['property_flip_id' => $request->property_flip_id])
				->withErrors($validator)
				->withInput()
				->with('property_flip_id', $request->property_flip_id);
		}
		
		$user = Auth::user();
		$property_flip_id = Util::getQueryParameter($request->property_flip_id);
		$attorney_id = Util::getQueryParameter($request->attorney_id);
		$contact_id = Util::getQueryParameter($request->contact_id);
		$lookup_attorney_type_id = Util::getQueryParameter($request->lookup_attorney_type_id);
		$property_flip = PropertyFlip::find($property_flip_id);
		$attorney = Attorney::find($attorney_id);
		$contact = Contact::find($contact_id);
		if (!$this->isDuplicate($property_flip_id, $contact_id, $lookup_attorney_type_id))
		{
			$property_flip->attorneys()->attach($contact, [
					'lookup_attorney_type_id' => $lookup_attorney_type_id,
					'created_by_id' => $user->id,
					'created_at'=> new Carbon
			]);
			
			/* Auditing */
			(new LinkAttorneyPropertyFlipAuditor($request, $property_flip, $attorney, $contact, $lookup_attorney_type_id, $user))->log();
			
			return redirect()->action('PropertyFlipController@getViewPropertyFlip', [
					'property_flip_Id' => $property_flip->id
			])->with(['message' => 'Attorney Contact linked']);
		}
		return redirect()->action('PropertyFlipController@getViewPropertyFlip', [
				'property_flip_Id' => $property_flip->id
		]);
	}
	
	/**
	 * Validate if the attorney contact was not already added for the property flip
	 * 
	 * @param unknown $property_flip
	 * @param unknown $contact_id
	 * @return boolean
	 */
	private function isDuplicate($property_flip_id, $contact_id, $lookup_attorney_type_id)
	{
		$attorney_contacts = DB::table('attorney_property_flip')
			->where('contact_id', '=', $contact_id)
			->where('property_flip_id', '=', $property_flip_id)
			->where('lookup_attorney_type_id', '=', $lookup_attorney_type_id)
			->select('attorney_property_flip.contact_id')
			->get();
		if (count($attorney_contacts) >= 1)
		{
			return true;
		}
		return false;
	}
	
	/**
	 * Get the contacts for the selected attorneys via ajax
	 *
	 * @param Request $request
	 * @return string
	 */
	public function postAjaxAttorneyContacts(Request $request)
	{
		$attorney_id = Util::getQueryParameter($request->attorney_id);
		$attorney_contacts = LookupUtil::retrieveAttorneyContactsAjax($attorney_id);
		return json_encode($attorney_contacts);
	}
	
	/**
	 * Do the actual linking of the attorney contact to the property flip
	 *
	 * @param Request $request
	 */
	public function postDoLinkAttorneyContactDelete(Request $request)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::ATTORNEYS_TAB);
		$user = Auth::user();
		$property_flip_id = Util::getQueryParameter($request->property_flip_id);
		$contact_id = Util::getQueryParameter($request->contact_id);
		$lookup_attorney_type_id = Util::getQueryParameter($request->lookup_attorney_type_id);
		$property_flip = PropertyFlip::find($property_flip_id);
		$contact = Contact::find($contact_id);
		DB::table('attorney_property_flip')
			->where('contact_id', '=', $contact_id)
			->where('property_flip_id', '=', $property_flip_id)
			->where('lookup_attorney_type_id', '=', $lookup_attorney_type_id)
			->limit(1)
			->delete();
		
		/* Auditing */
		(new DeleteAttorneyPropertyFlipAuditor($request, $property_flip, $contact, $lookup_attorney_type_id, $user))->log();
		
		return redirect()->action('PropertyFlipController@getViewPropertyFlip', [
			'property_flip_Id' => $property_flip->id
		])->with(['message' => 'Attorney Contact removed from Property Flip']);
	}
}
