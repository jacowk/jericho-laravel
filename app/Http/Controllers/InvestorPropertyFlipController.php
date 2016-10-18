<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\PropertyFlip;
use jericho\Contact;
use jericho\Util\Util;
use jericho\Util\LookupUtil;
use jericho\Investor;
use Carbon\Carbon;
use jericho\LookupInvestorType;
use DB;
use jericho\Util\TabConstants;

/**
 * This class is a controller for linking the contacts of investors to property flips
 *
 * @author Jaco Koekemoer
 * Date: 2016-10-27
 *
 */
class InvestorPropertyFlipController extends Controller
{
	/**
	 * Post link investor
	 *
	 * @param Request $request
	 * @param unknown $property_flip_id
	 */
	public function postLinkContactInvestor(Request $request)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::INVESTORS_TAB);
		$property_flip_id = Util::getQueryParameter($request->property_flip_id);
		$contacts = LookupUtil::retrieveContactsLookup();
		return view ('property-flip.link-contact-investor', [
				'property_flip_id' => $property_flip_id,
				'contacts' => $contacts
		]);
	}
	
	/**
	 * Do the actual linking of the investor contact to the property flip
	 *
	 * @param Request $request
	 */
	public function postDoLinkContactInvestor(Request $request)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::INVESTORS_TAB);
		$validator = Validator::make($request->all(), [
				'property_flip_id' => 'required|not_in:-1',
				'contact_id' => 'required|not_in:-1',
				'investment_amount' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('link-contact-investor')
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$property_flip_id = Util::getQueryParameter($request->property_flip_id);
		$contact_id = Util::getQueryParameter($request->contact_id);
		$investment_amount = Util::processCurrencyValue($request->investment_amount);
		$property_flip = PropertyFlip::find($property_flip_id);
		$contact = Contact::find($contact_id);
		if (!$this->isDuplicate($property_flip_id, $contact_id))
		{
			$property_flip->investors()->attach($contact, [
					'investment_amount' => $investment_amount,
					'created_by_id' => $user->id,
					'created_at'=> new Carbon
			]);
			return redirect()->action('PropertyFlipController@getViewPropertyFlip', ['property_flip_Id' => $property_flip->id])
				->with(['message' => 'Investor Contact linked']);
		}
		return redirect()->action('PropertyFlipController@getViewPropertyFlip', ['property_flip_Id' => $property_flip->id]);
	}
	
	/**
	 * Validate if the investor contact was not already added for the property flip
	 * 
	 * @param unknown $property_flip
	 * @param unknown $contact_id
	 * @return boolean
	 */
	private function isDuplicate($property_flip_id, $contact_id)
	{
		$investor_contacts = DB::table('investor_property_flip')
			->where('contact_id', '=', $contact_id)
			->where('property_flip_id', '=', $property_flip_id)
			->select('investor_property_flip.contact_id')
			->get();
		if (count($investor_contacts) >= 1)
		{
			return true;
		}
		return false;
	}
	
	/**
	 * Do the actual linking of the investor contact to the property flip
	 *
	 * @param Request $request
	 */
	public function postDoLinkContactInvestorDelete(Request $request)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::INVESTORS_TAB);
		$user = Auth::user();
		$property_flip_id = Util::getQueryParameter($request->property_flip_id);
		$contact_id = Util::getQueryParameter($request->contact_id);
		$property_flip = PropertyFlip::find($property_flip_id);
		$contact = Contact::find($contact_id);
		DB::table('investor_property_flip')
			->where('contact_id', '=', $contact_id)
			->where('property_flip_id', '=', $property_flip_id)
			->limit(1)
			->delete();
		return redirect()->action('PropertyFlipController@getViewPropertyFlip', ['property_flip_Id' => $property_flip->id])
			->with(['message' => 'Investor removed from Property Flip']);
	}
}
