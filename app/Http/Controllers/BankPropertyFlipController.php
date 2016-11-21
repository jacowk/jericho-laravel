<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\PropertyFlip;
use jericho\Contact;
use jericho\Util\Util;
use jericho\Bank;
use Carbon\Carbon;
use DB;
use jericho\Util\TabConstants;
use jericho\Audits\LinkBankPropertyFlipAuditor;
use jericho\Audits\DeleteBankPropertyFlipAuditor;
use jericho\Lookup\BankLookupRetriever;
use jericho\Lookup\BankContactAjaxLookupRetriever;

/**
 * This class is a controller for performing CRUD operations on property flips
 *
 * @author Jaco Koekemoer
 * Date: 2016-09-28
 *
 */
class BankPropertyFlipController extends Controller
{
	/**
	 * Post link bank
	 *
	 * @param Request $request
	 * @param unknown $property_flip_id
	 */
	public function postLinkBankContact(Request $request)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::BANKS_TAB);
		$property_flip_id = Util::getNumericQueryParameter($request->property_flip_id);
		$banks = (new BankLookupRetriever())->execute();
		$contacts = array();
		$contacts['-1'] = "Select Bank Contact";
		return view ('property-flip.link-bank-contact', [
				'banks' => $banks,
				'property_flip_id' => $property_flip_id,
				'contacts' => $contacts
		]);
	}
	
	/**
	 * Do the actual linking of the bank contact to the property flip
	 *
	 * @param Request $request
	 */
	public function postDoLinkBankContact(Request $request)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::BANKS_TAB);
		
		$validator = Validator::make($request->all(), [
				'property_flip_id' => 'required',
				'bank_id' => 'required|not_in:-1',
				'contact_id' => 'required|not_in:-1'
		]);
		
		if ($validator->fails()) {
			return redirect()
			->route('link-bank-contact', ['property_flip_id' => $request->property_flip_id])
			->withErrors($validator)
			->withInput()
			->with('property_flip_id', $request->property_flip_id);
		}
		$user = Auth::user();
		$property_flip_id = Util::getNumericQueryParameter($request->property_flip_id);
		$bank_id = Util::getNumericQueryParameter($request->bank_id);
		$contact_id = Util::getNumericQueryParameter($request->contact_id);
		$property_flip = PropertyFlip::find($property_flip_id);
		$bank = Bank::find($bank_id);
		$contact = Contact::find($contact_id);
		if (!$this->isDuplicate($property_flip_id, $contact_id))
		{
			$property_flip->banks()->attach($contact, [
					'created_by_id' => $user->id,
					'created_at'=> new Carbon
			]);
			
			/* Auditing */
			(new LinkBankPropertyFlipAuditor($request, $property_flip, $bank, $contact, $user))->log();
			
			return redirect()->action('PropertyFlipController@getViewPropertyFlip', ['property_flip_Id' => $property_flip->id])
				->with(['message' => 'Bank Contact linked']);
		}
		return redirect()->action('PropertyFlipController@getViewPropertyFlip', ['property_flip_Id' => $property_flip->id]);
	}
	
	/**
	 * Validate if the bank contact was not already added for the property flip
	 * 
	 * @param unknown $property_flip
	 * @param unknown $contact_id
	 * @return boolean
	 */
	private function isDuplicate($property_flip_id, $contact_id)
	{
		$bank_contacts = DB::table('bank_property_flip')
			->where('contact_id', '=', $contact_id)
			->where('property_flip_id', '=', $property_flip_id)
			->select('bank_property_flip.contact_id')
			->get();
		if (count($bank_contacts) >= 1)
		{
			return true;
		}
		return false;
	}
	
	/**
	 * Get the contacts for the selected banks via ajax
	 *
	 * @param Request $request
	 * @return string
	 */
	public function postAjaxBankContacts(Request $request)
	{
		$bank_id = Util::getQueryParameter($request->bank_id);
		$bank_contacts = (new BankContactAjaxLookupRetriever($bank_id))->execute();
		return json_encode($bank_contacts);
	}
	
	/**
	 * Do the actual linking of the bank contact to the property flip
	 *
	 * @param Request $request
	 */
	public function postDoLinkBankContactDelete(Request $request)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::BANKS_TAB);
		$user = Auth::user();
		$property_flip_id = Util::getNumericQueryParameter($request->property_flip_id);
		$contact_id = Util::getNumericQueryParameter($request->contact_id);
		$property_flip = PropertyFlip::find($property_flip_id);
		$contact = Contact::find($contact_id);
		DB::table('bank_property_flip')
			->where('contact_id', '=', $contact_id)
			->where('property_flip_id', '=', $property_flip_id)
			->limit(1)
			->delete();
		
		/* Auditing */
		(new DeleteBankPropertyFlipAuditor($request, $property_flip, $contact, $user))->log();
			
		return redirect()->action('PropertyFlipController@getViewPropertyFlip', ['property_flip_Id' => $property_flip->id])
			->with(['message' => 'Bank Contact removed from Property Flip']);
	}
}
