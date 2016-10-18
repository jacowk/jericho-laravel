<?php
namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\PropertyFlip;
use jericho\Property;
use jericho\Contact;
use jericho\Util\Util;
use jericho\Util\LookupUtil;
use jericho\Util\TabConstants;
use jericho\LookupAttorneyType;
use jericho\Milestone;
use jericho\Attorney;
use DB;
use Carbon\Carbon;

/**
 * This class is a controller for performing CRUD operations on property_flips
 *
 * @author Jaco Koekemoer
 * Date: 2016-09-19
 *
 */
class PropertyFlipController extends Controller
{
	/**
	 * Load search page
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getSearchPropertyFlip()
	{
		return view('property-flip.search-property-flip');
	}
	
	/**
	 * Search for property_flips
	 *
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function postDoSearchPropertyFlip(Request $request)
	{
		if (Util::isValidRequestVariable($request->name))
		{
			$name = $request->name;
			$property_flips = PropertyFlip::where('name', 'like', '%' . $name . '%')->orderBy('name', 'asc')->get();
		}
		else
		{
			$property_flips = PropertyFlip::orderBy('name', 'asc')->get();
		}
		return view('property-flip.search-property-flip', ['property_flips' => $property_flips]);
	}
	
	/**
	 * Load page to add an property_flip
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddPropertyFlip(Request $request, $property_id)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::GENERAL_TAB);
		$property = Property::find($property_id);
		$contacts = LookupUtil::retrieveContactsLookup();
		$finance_statuses = LookupUtil::retrieveFinanceStatusLookup();
		$seller_statuses = LookupUtil::retrieveSellerStatusLookup();
		return view('property-flip.add-property-flip', [
			'property' => $property,
			'contacts' => $contacts,
			'finance_statuses' => $finance_statuses,
			'seller_statuses' => $seller_statuses
		]);
	}
	
	/**
	 * Add an property_flip
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddPropertyFlip(Request $request)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::GENERAL_TAB);
// 		$this->validate($request, [
// 			'reference_number' => 'required',
// 			'property_id' => 'required',
// 		]);
		$validator = Validator::make($request->all(), [
			'reference_number' => 'required',
			'property_id' => 'required',
		]);
		
		if ($validator->fails()) {
			return redirect('add-property-flip')
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$property_flip = new PropertyFlip();
		$property_flip->reference_number = Util::getQueryParameter($request->reference_number);
		$property_flip->title_deed_number = Util::getQueryParameter($request->title_deed_number);
		$property_flip->case_number = Util::getQueryParameter($request->case_number);
		$property_flip->seller_id = Util::getQueryParameter($request->seller_id);
		$property_flip->selling_price = Util::processCurrencyValue($request->selling_price);
		$property_flip->purchaser_id = Util::getQueryParameter($request->purchaser_id);
		$property_flip->purchase_price = Util::processCurrencyValue($request->purchase_price);
		$property_flip->finance_status_id = Util::getQueryParameter($request->finance_status_id);
		$property_flip->seller_status_id = Util::getQueryParameter($request->seller_status_id);
		$property_flip->property_id = Util::getQueryParameter($request->property_id);
		$property_flip->created_by_id = $user->id;
		$property_flip->save();
		return redirect()->action('PropertyFlipController@getViewPropertyFlip', ['property_flip_Id' => $property_flip->id])
			->with(['message' => 'PropertyFlip saved']);
	}
	
	/**
	 * Load page to update an property_flip
	 *
	 * @param Request $request
	 * @param unknown $property_flip_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdatePropertyFlip(Request $request, $property_flip_id)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::GENERAL_TAB);
		$property_flip = PropertyFlip::find($property_flip_id);
		$contacts = LookupUtil::retrieveContactsLookup();
		$finance_statuses = LookupUtil::retrieveFinanceStatusLookup();
		$seller_statuses = LookupUtil::retrieveSellerStatusLookup();
		return view('property-flip.update-property-flip', [
			'property_flip' => $property_flip,
			'contacts' => $contacts,
			'finance_statuses' => $finance_statuses,
			'seller_statuses' => $seller_statuses
		]);
	}
	
	/**
	 * Update an property_flip
	 *
	 * @param Request $request
	 * @param unknown $property_flip_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdatePropertyFlip(Request $request, $property_flip_id)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::GENERAL_TAB);
// 		$this->validate($request, [
// 			'reference_number' => 'required',
// 			'property_id' => 'required',
// 		]);
		$validator = Validator::make($request->all(), [
			'reference_number' => 'required',
			'property_id' => 'required',
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('update-property-flip', ['property_flip_id' => $property_flip_id])
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$property_flip = PropertyFlip::find($property_flip_id);
		$property_flip->reference_number = Util::getQueryParameter($request->reference_number);
		$property_flip->title_deed_number = Util::getQueryParameter($request->title_deed_number);
		$property_flip->case_number = Util::getQueryParameter($request->case_number);
		$property_flip->seller_id = Util::getQueryParameter($request->seller_id);
		$property_flip->selling_price = Util::processCurrencyValue($request->selling_price);
		$property_flip->purchaser_id = Util::getQueryParameter($request->purchaser_id);
		$property_flip->purchase_price = Util::processCurrencyValue($request->purchase_price);
		$property_flip->finance_status_id = Util::getQueryParameter($request->finance_status_id);
		$property_flip->seller_status_id = Util::getQueryParameter($request->seller_status_id);
		$property_flip->property_id = Util::getQueryParameter($request->property_id);
		$property_flip->updated_by_id = $user->id;
		$property_flip->save();
		return redirect()->action('PropertyFlipController@getViewPropertyFlip', ['property_flip_Id' => $property_flip->id])
			->with(['message' => 'PropertyFlip updated']);
	}
	
	/**
	 * Load the page to view an property flip
	 *
	 * @param Request $request
	 * @param unknown $property_flip_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewPropertyFlip(Request $request, $property_flip_id)
	{
		$property_flip = PropertyFlip::find($property_flip_id);
		$property = Property::find($property_flip->property_id);
		$attorney_contacts = $this->populateAttorneys($property_flip);
		$contact_estate_agents = $this->populateEstateAgents($property_flip);
		$contact_contractors = $this->populateContractors($property_flip);
		$bank_contacts = $this->populateBanks($property_flip);
		$contact_investors = $this->populateInvestors($property_flip);
		return view('property-flip.view-property-flip', [
			'property_flip' => $property_flip,
			'attorney_contacts' => $attorney_contacts,
			'contact_estate_agents' => $contact_estate_agents,
			'contact_contractors' => $contact_contractors,
			'bank_contacts' => $bank_contacts,
			'contact_investors' => $contact_investors,
			'property' => $property
		]);
	}
	
	private function populateAttorneys($property_flip)
	{
		$attorney_contacts = DB::table('attorney_property_flip')
						->join('contacts', 'contacts.id', '=' ,'attorney_property_flip.contact_id')
						->join('property_flips', 'property_flips.id', '=', 'attorney_property_flip.property_flip_id')
						->join('attorney_contact', 'attorney_contact.contact_id', '=', 'contacts.id')
						->join('attorneys', 'attorneys.id', '=', 'attorney_contact.attorney_id')
						->join('lookup_attorney_types', 'lookup_attorney_types.id', '=', 'attorney_property_flip.lookup_attorney_type_id')
						->where('attorney_property_flip.property_flip_id', '=', $property_flip->id)
						->select('attorneys.name as attorney_name', 
								'contacts.firstname as contact_firstname',
								'contacts.surname as contact_surname',
								'contacts.work_email as contact_work_email',
								'contacts.work_tel_no as contact_work_tel_no',
								'contacts.cell_no as contact_cell_no',
								'lookup_attorney_types.description as lookup_attorney_type',
								'lookup_attorney_types.id as lookup_attorney_type_id',
								'contacts.id as contact_id')
						->get();
		return $attorney_contacts;
	}
	
	private function populateEstateAgents($property_flip)
	{
		$contact_estate_agents = DB::table('estate_agent_property_flip')
						->join('contacts', 'contacts.id', '=' ,'estate_agent_property_flip.contact_id')
						->join('property_flips', 'property_flips.id', '=', 'estate_agent_property_flip.property_flip_id')
						->join('contact_estate_agent', 'contact_estate_agent.contact_id', '=', 'contacts.id')
						->join('estate_agents', 'estate_agents.id', '=', 'contact_estate_agent.estate_agent_id')
						->join('lookup_estate_agent_types', 'lookup_estate_agent_types.id', '=', 'estate_agent_property_flip.lookup_estate_agent_type_id')
						->where('estate_agent_property_flip.property_flip_id', '=', $property_flip->id)
						->select('estate_agents.name as estate_agent_name',
								'contacts.firstname as contact_firstname',
								'contacts.surname as contact_surname',
								'contacts.work_email as contact_work_email',
								'contacts.work_tel_no as contact_work_tel_no',
								'contacts.cell_no as contact_cell_no',
								'lookup_estate_agent_types.description as lookup_estate_agent_type',
								'lookup_estate_agent_types.id as lookup_estate_agent_type_id',
								'contacts.id as contact_id')
								->get();
		return $contact_estate_agents;
	}
	
	private function populateContractors($property_flip)
	{
		$contact_contractors = DB::table('contractor_property_flip')
						->join('contacts', 'contacts.id', '=' ,'contractor_property_flip.contact_id')
						->join('property_flips', 'property_flips.id', '=', 'contractor_property_flip.property_flip_id')
						->join('contact_contractor', 'contact_contractor.contact_id', '=', 'contacts.id')
						->join('contractors', 'contractors.id', '=', 'contact_contractor.contractor_id')
						->join('lookup_contractor_types', 'lookup_contractor_types.id', '=', 'contractor_property_flip.lookup_contractor_type_id')
						->where('contractor_property_flip.property_flip_id', '=', $property_flip->id)
						->select('contractors.name as contractor_name',
								'contacts.firstname as contact_firstname',
								'contacts.surname as contact_surname',
								'contacts.work_email as contact_work_email',
								'contacts.work_tel_no as contact_work_tel_no',
								'contacts.cell_no as contact_cell_no',
								'lookup_contractor_types.description as lookup_contractor_type',
								'lookup_contractor_types.id as lookup_contractor_type_id',
								'contacts.id as contact_id')
								->get();
		return $contact_contractors;
	}
	
	private function populateBanks($property_flip)
	{
		$contact_banks = DB::table('bank_property_flip')
						->join('contacts', 'contacts.id', '=' ,'bank_property_flip.contact_id')
						->join('property_flips', 'property_flips.id', '=', 'bank_property_flip.property_flip_id')
						->join('bank_contact', 'bank_contact.contact_id', '=', 'contacts.id')
						->join('banks', 'banks.id', '=', 'bank_contact.bank_id')
						->where('bank_property_flip.property_flip_id', '=', $property_flip->id)
						->select('banks.name as bank_name',
								'contacts.firstname as contact_firstname',
								'contacts.surname as contact_surname',
								'contacts.work_email as contact_work_email',
								'contacts.work_tel_no as contact_work_tel_no',
								'contacts.cell_no as contact_cell_no',
								'contacts.id as contact_id')
								->get();
		return $contact_banks;
	}
	
	private function populateInvestors($property_flip)
	{
		$contact_investors = DB::table('investor_property_flip')
						->join('contacts', 'contacts.id', '=' ,'investor_property_flip.contact_id')
						->join('property_flips', 'property_flips.id', '=', 'investor_property_flip.property_flip_id')
						->where('investor_property_flip.property_flip_id', '=', $property_flip->id)
						->select('contacts.firstname as contact_firstname',
								'contacts.surname as contact_surname',
								'contacts.work_email as contact_work_email',
								'contacts.work_tel_no as contact_work_tel_no',
								'contacts.cell_no as contact_cell_no',
								'contacts.id as contact_id',
								'investor_property_flip.investment_amount')
								->get();
		return $contact_investors;
	}
}