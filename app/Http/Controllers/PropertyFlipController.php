<?php
namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\PropertyFlip;
use jericho\Property;
use jericho\Util\Util;
use jericho\Util\TabConstants;
use jericho\LookupAttorneyType;
use jericho\Milestone;
use jericho\Attorney;
use DB;
use Carbon\Carbon;
use jericho\Accounts\AccountBalanceCalculator;
use jericho\Accounts\AccountConstants;
use jericho\Accounts\AccountViewDataGenerator;
use jericho\Lookup\ContactLookupRetriever;
use jericho\Lookup\FinanceStatusLookupRetriever;
use jericho\Lookup\SellerStatusLookupRetriever;
use jericho\Lookup\PropertyStatusLookupRetriever;
use jericho\Lookup\LeadTypeLookupRetriever;
use jericho\Contacts\AttorneyContactRetriever;
use jericho\Contacts\EstateAgentContactRetriever;
use jericho\Contacts\BankContactRetriever;
use jericho\Contacts\ContractorContactRetriever;
use jericho\Contacts\InvestorContactRetriever;
use jericho\Http\Controllers\Auth\AuthUserRetriever;
use jericho\Validation\UpdateObjectValidator;
use jericho\Validation\ViewObjectValidator;

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
		$contacts = (new ContactLookupRetriever())->execute();
		$finance_statuses = (new FinanceStatusLookupRetriever())->execute();
		$seller_statuses = (new SellerStatusLookupRetriever())->execute();
		$property_statuses = (new PropertyStatusLookupRetriever())->execute();
		$lead_types = (new LeadTypeLookupRetriever())->execute();
		
		return view('property-flip.add-property-flip', [
			'property' => $property,
			'contacts' => $contacts,
			'finance_statuses' => $finance_statuses,
			'seller_statuses' => $seller_statuses,
			'property_statuses' => $property_statuses,
			'lead_types' => $lead_types
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
		$validator = Validator::make($request->all(), [
			'reference_number' => 'required|unique:property_flips|numeric',
			'property_id' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('add-property-flip', ['property_id' => $request->property_id])
				->withErrors($validator)
				->withInput();
		}
		$user = (new AuthUserRetriever())->retrieveUser();
		$property_flip = new PropertyFlip();
		$property_flip->reference_number = Util::getQueryParameter($request->reference_number);
		$property_flip->title_deed_number = Util::getQueryParameter($request->title_deed_number);
		$property_flip->case_number = Util::getQueryParameter($request->case_number);
		$property_flip->seller_id = Util::getNumericQueryParameter($request->seller_id);
		$property_flip->selling_price = Util::processCurrencyValue($request->selling_price);
		$property_flip->purchaser_id = Util::getNumericQueryParameter($request->purchaser_id);
		$property_flip->purchase_price = Util::processCurrencyValue($request->purchase_price);
		$property_flip->finance_status_id = Util::getNumericQueryParameter($request->finance_status_id);
		$property_flip->seller_status_id = Util::getNumericQueryParameter($request->seller_status_id);
		$property_flip->property_status_id = Util::getNumericQueryParameter($request->property_status_id);
		$property_flip->lead_type_id = Util::getNumericQueryParameter($request->lead_type_id);
		$property_flip->property_id = Util::getNumericQueryParameter($request->property_id);
		$property_flip->created_by_id = $user->id;
		$property_flip->save();
		return redirect()->action('PropertyFlipController@getViewPropertyFlip', ['property_flip_Id' => $property_flip->id])
			->with(['message' => 'Property Flip saved']);
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
		(new UpdateObjectValidator())->validate($property_flip, 'property flip', $property_flip_id);
		$contacts = (new ContactLookupRetriever())->execute();
		$finance_statuses = (new FinanceStatusLookupRetriever())->execute();
		$seller_statuses = (new SellerStatusLookupRetriever())->execute();
		$property_statuses = (new PropertyStatusLookupRetriever())->execute();
		$lead_types = (new LeadTypeLookupRetriever())->execute();
		
		return view('property-flip.update-property-flip', [
			'property_flip' => $property_flip,
			'contacts' => $contacts,
			'finance_statuses' => $finance_statuses,
			'seller_statuses' => $seller_statuses,
			'property_statuses' => $property_statuses,
			'lead_types' => $lead_types
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
		$validator = Validator::make($request->all(), [
			'reference_number' => 'required|numeric|unique:property_flips,reference_number,' . $property_flip_id,
			'property_id' => 'required',
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('update-property-flip', ['property_flip_id' => $property_flip_id])
				->withErrors($validator)
				->withInput();
		}
		$user = (new AuthUserRetriever())->retrieveUser();
		$property_flip = PropertyFlip::find($property_flip_id);
		(new UpdateObjectValidator())->validate($property_flip, 'property flip', $property_flip_id);
		$property_flip->reference_number = Util::getQueryParameter($request->reference_number);
		$property_flip->title_deed_number = Util::getQueryParameter($request->title_deed_number);
		$property_flip->case_number = Util::getQueryParameter($request->case_number);
		$property_flip->seller_id = Util::getNumericQueryParameter($request->seller_id);
		$property_flip->selling_price = Util::processCurrencyValue($request->selling_price);
		$property_flip->purchaser_id = Util::getNumericQueryParameter($request->purchaser_id);
		$property_flip->purchase_price = Util::processCurrencyValue($request->purchase_price);
		$property_flip->finance_status_id = Util::getNumericQueryParameter($request->finance_status_id);
		$property_flip->seller_status_id = Util::getNumericQueryParameter($request->seller_status_id);
		$property_flip->property_status_id = Util::getNumericQueryParameter($request->property_status_id);
		$property_flip->lead_type_id = Util::getNumericQueryParameter($request->lead_type_id);
		$property_flip->property_id = Util::getNumericQueryParameter($request->property_id);
		$property_flip->updated_by_id = $user->id;
		$property_flip->save();
		return redirect()->action('PropertyFlipController@getViewPropertyFlip', ['property_flip_Id' => $property_flip->id])
			->with(['message' => 'Property Flip updated']);
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
		(new ViewObjectValidator())->validate($property_flip, 'property flip', $property_flip_id);
		$property = Property::find($property_flip->property_id);
		$attorney_contacts = (new AttorneyContactRetriever($property_flip))->execute();
		$estate_agent_contacts = (new EstateAgentContactRetriever($property_flip))->execute();
		$contractor_contacts = (new ContractorContactRetriever($property_flip))->execute();
		$bank_contacts = (new BankContactRetriever($property_flip))->execute();
		$investor_contacts = (new InvestorContactRetriever($property_flip))->execute();
		
		$accountBalanceCalculator = new AccountBalanceCalculator();
		$profit_loss_balance = $accountBalanceCalculator->calculate(AccountConstants::PROFIT_AND_LOSS_ACCOUNT, 
			$property_flip->transactions);
		
		/* Generate account transactions data for the view */
		$account_view_data_generator = new AccountViewDataGenerator();
		$account_transactions = $account_view_data_generator->generateData($property_flip_id);
		
		return view('property-flip.view-property-flip', [
			'property_flip' => $property_flip,
			'attorney_contacts' => $attorney_contacts,
			'estate_agent_contacts' => $estate_agent_contacts,
			'contractor_contacts' => $contractor_contacts,
			'bank_contacts' => $bank_contacts,
			'investor_contacts' => $investor_contacts,
			'property' => $property,
			'profit_loss_balance' => $profit_loss_balance,
			'account_transactions' => $account_transactions
		]);
	}
}