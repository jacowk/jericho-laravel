<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\PropertyFlip;
use jericho\Contact;
use jericho\Util\Util;
use jericho\EstateAgent;
use Carbon\Carbon;
use jericho\LookupEstateAgentType;
use DB;
use jericho\Util\TabConstants;
use jericho\Audits\LinkEstateAgentPropertyFlipAuditor;
use jericho\Audits\DeleteEstateAgentPropertyFlipAuditor;
use jericho\Lookup\EstateAgentTypeLookupRetriever;
use jericho\Lookup\EstateAgentLookupRetriever;
use jericho\Lookup\ContactEstateAgentAjaxLookupRetriever;
use jericho\Http\Controllers\Auth\AuthUserRetriever;

/**
 * This class is a controller for linking the contacts of estate agents to property flips
 *
 * @author Jaco Koekemoer
 * Date: 2016-09-27
 *
 */
class EstateAgentPropertyFlipController extends Controller
{
	/**
	 * Post link estate agent
	 *
	 * @param Request $request
	 * @param unknown $property_flip_id
	 */
	public function postLinkContactEstateAgent(Request $request)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::ESTATE_AGENTS_TAB);
		$property_flip_id = Util::getNumericQueryParameter($request->property_flip_id);
		$estate_agents = (new EstateAgentLookupRetriever())->execute();
		$lookup_estate_agent_types = (new EstateAgentTypeLookupRetriever())->execute();
		$contacts = array();
		$contacts['-1'] = "Select Estate Agent Contact";
		return view ('property-flip.link-estate-agent-contact', [
				'estate_agents' => $estate_agents,
				'property_flip_id' => $property_flip_id,
				'contacts' => $contacts,
				'lookup_estate_agent_types' => $lookup_estate_agent_types
		]);
	}
	
	/**
	 * Do the actual linking of the estate agent contact to the property flip
	 *
	 * @param Request $request
	 */
	public function postDoLinkContactEstateAgent(Request $request)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::ESTATE_AGENTS_TAB);
		$validator = Validator::make($request->all(), [
				'property_flip_id' => 'required',
				'estate_agent_id' => 'required|not_in:-1',
				'contact_id' => 'required|not_in:-1',
				'lookup_estate_agent_type_id' => 'required|not_in:-1'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('link-estate-agent-contact', ['property_flip_id' => $request->property_flip_id])
				->withErrors($validator)
				->withInput()
				->with('property_flip_id', $request->property_flip_id);
		}
		$user = (new AuthUserRetriever())->retrieveUser();
		$property_flip_id = Util::getNumericQueryParameter($request->property_flip_id);
		$estate_agent_id = Util::getNumericQueryParameter($request->estate_agent_id);
		$contact_id = Util::getNumericQueryParameter($request->contact_id);
		$lookup_estate_agent_type_id = Util::getNumericQueryParameter($request->lookup_estate_agent_type_id);
		$property_flip = PropertyFlip::find($property_flip_id);
		$estate_agent = EstateAgent::find($estate_agent_id);
		$contact = Contact::find($contact_id);
		if (!$this->isDuplicate($property_flip_id, $contact_id, $lookup_estate_agent_type_id))
		{
			$property_flip->estate_agents()->attach($contact, [
					'lookup_estate_agent_type_id' => $lookup_estate_agent_type_id,
					'created_by_id' => $user->id,
					'created_at'=> new Carbon
			]);
			
			/* Auditing */
			(new LinkEstateAgentPropertyFlipAuditor($request, $property_flip, $estate_agent, $contact, $lookup_estate_agent_type_id, $user))->log();
			
			return redirect()->action('PropertyFlipController@getViewPropertyFlip', ['property_flip_Id' => $property_flip->id])
				->with(['message' => 'Estate Agent Contact linked']);
		}
		return redirect()->action('PropertyFlipController@getViewPropertyFlip', ['property_flip_Id' => $property_flip->id]);
	}
	
	/**
	 * Validate if the estate agent contact was not already added for the property flip
	 * 
	 * @param unknown $property_flip
	 * @param unknown $contact_id
	 * @return boolean
	 */
	private function isDuplicate($property_flip_id, $contact_id, $lookup_estate_agent_type_id)
	{
		$estate_agent_contacts = DB::table('estate_agent_property_flip')
			->where('contact_id', '=', $contact_id)
			->where('property_flip_id', '=', $property_flip_id)
			->where('lookup_estate_agent_type_id', '=', $lookup_estate_agent_type_id)
			->select('estate_agent_property_flip.contact_id')
			->get();
		if (count($estate_agent_contacts) >= 1)
		{
			return true;
		}
		return false;
	}
	
	/**
	 * Get the contacts for the selected estate agents via ajax
	 *
	 * @param Request $request
	 * @return string
	 */
	public function postAjaxContactEstateAgents(Request $request)
	{
		$estate_agent_id = Util::getNumericQueryParameter($request->estate_agent_id);
		$estate_agent_contacts = (new ContactEstateAgentAjaxLookupRetriever($estate_agent_id))->execute();
		return json_encode($estate_agent_contacts);
	}
	
	/**
	 * Do the actual linking of the estate agent contact to the property flip
	 *
	 * @param Request $request
	 */
	public function postDoLinkContactEstateAgentDelete(Request $request)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::ESTATE_AGENTS_TAB);
		$user = (new AuthUserRetriever())->retrieveUser();
		$property_flip_id = Util::getNumericQueryParameter($request->property_flip_id);
		$contact_id = Util::getQueryParameter($request->contact_id);
		$lookup_estate_agent_type_id = Util::getNumericQueryParameter($request->lookup_estate_agent_type_id);
		$property_flip = PropertyFlip::find($property_flip_id);
		$contact = Contact::find($contact_id);
		DB::table('estate_agent_property_flip')
			->where('contact_id', '=', $contact_id)
			->where('property_flip_id', '=', $property_flip_id)
			->where('lookup_estate_agent_type_id', '=', $lookup_estate_agent_type_id)
			->limit(1)
			->delete();
		
		/* Auditing */
		(new DeleteEstateAgentPropertyFlipAuditor($request, $property_flip, $contact, $lookup_estate_agent_type_id, $user))->log();
		
		return redirect()->action('PropertyFlipController@getViewPropertyFlip', ['property_flip_Id' => $property_flip->id])
			->with(['message' => 'Estate Agent Contact removed from Property Flip']);
	}
}
