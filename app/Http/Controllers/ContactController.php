<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\Contact;
use jericho\User;
use jericho\LookupMaritalStatus;
use jericho\LookupTitle;
use jericho\Util\Util;
use jericho\Util\ModelConstants;
use jericho\Util\LookupUtil;
use jericho\Attorney;
use jericho\Bank;
use jericho\Contractor;
use jericho\EstateAgent;
use DB;

/**
 * This class is a controller for performing CRUD operations on contacts
 * 
 * @author Jaco Koekemoer
 * Date: 2016-09-12
 *
 */
class ContactController extends Controller
{
	/**
	 * Load search page
	 * 
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
    public function getSearchContact()
    {
    	return view('contact.search-contact', [
    		'firstname' => null,
    		'surname' => null
    	]);
    }
    
    /**
     * Search for contacts
     * 
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function postDoSearchContact(Request $request)
    {
    	$model_name = ModelConstants::NONE_MODEL_NAME;
    	$model_id = 0;
    	$firstname = Util::getQueryParameter($request->firstname);
    	$surname = Util::getQueryParameter($request->surname);
    	$contacts = Contact::where([
    					['firstname', 'like', '%' . $firstname . '%'],
    					['surname', 'like', '%' . $surname . '%']
    				])
    				->orderBy('surname', 'asc')
    				->get();
    	return view('contact.search-contact', [
    		'contacts' => $contacts, 
    		'model_name' => $model_name,
    		'model_id' => $model_id,
    		'firstname' => $firstname,
    		'surname' => $surname
    	]);
    }
    
    /**
     * Load page to add an contact
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getAddContact(Request $request)
    {
    	$lookup_titles = LookupUtil::retrieveLookupTitles();
    	$lookup_marital_statuses = LookupUtil::retrieveLookupMaritalStatuses();
    	if (Util::isValidRequestVariable($request->model_name))
    	{
    		$model_name = $request->model_name;
    	}
    	else 
    	{
    		$model_name = "none";
    	}
    	if (Util::isValidRequestVariable($request->model_id))
    	{
    		$model_id = $request->model_id;
    	}
    	else
    	{
    		$model_id = "none";
    	}
    	$model_view_route = $this->getModelViewRoute($model_name, $model_id);
    	$model_id_name = $this->getModelIdName($model_name);
    	$link_description = $this->getLinkDescription($model_name);
    	return view('contact.add-contact', [
    			'lookup_titles' => $lookup_titles, 
    			'lookup_marital_statuses' => $lookup_marital_statuses,
    			'model_name' => $model_name,
    			'model_id' => $model_id,
	    		'model_view_route' => $model_view_route,
	    		'model_id_name' => $model_id_name,
	    		'link_description' => $link_description
    		]);
    }
    
    /**
     * Add an contact
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDoAddContact(Request $request)
    {
    	/* Do validation */
//     	$this->validate($request, [
//     		'firstname' => 'required',
//     		'home-tel' => 'numeric|min:10|max:10',
//     		'work-tel' => 'numeric|min:10|max:10',
//     		'cell-no' => 'numeric|min:10|max:10',
//     		'personal-email' => 'email',
//     		'work-email' => 'email',
//     		'id-number' => 'numeric|min:13|max:13'
//     	]);
    	
    	$validator = Validator::make($request->all(), [
    		'firstname' => 'required',
    		'home-tel' => 'numeric|min:10|max:10',
    		'work-tel' => 'numeric|min:10|max:10',
    		'cell-no' => 'numeric|min:10|max:10',
    		'personal-email' => 'email',
    		'work-email' => 'email',
    		'id-number' => 'numeric|min:13|max:13'
    	]);
    	 
    	if ($validator->fails()) {
    		return redirect()
	    		->route('add-contact')
	    		->withErrors($validator)
	    		->withInput()
    			->with('model_id', $request->model_id)
    			->with('model_name', $request->model_name);
    	}
    	
//     	DB::transaction(function (Request $request) {
    		/* Create and store the Contact */
    		$user = Auth::user();
    		$contact = new Contact();
    		$contact = $this->populateContactObject($request, $contact);
    		$contact->created_by_id = $user->id;
    		$contact->save();
    		 
    		/* Get applicable model and attach */
    		if (Util::isValidRequestVariable($request->model_name))
    		{
    			$model_name = $request->model_name;
    		}
    		else
    		{
    			$model_name = ModelConstants::NONE_MODEL_NAME;
    		}
    		if (Util::isValidRequestVariable($request->model_id))
    		{
    			$model_id = $request->model_id;
    		}
    		else 
    		{
    			$model_id = 0;
    		}
    		$this->attachContactToModel($request, $contact, $model_name, $model_id);
//     	});
    	
    	/* Redirect */
    	return redirect()->action('ContactController@getViewContact', [
    			'contact_Id' => $contact->id,
    			'model_name' => $model_name,
    			'model_id' => $model_id
    		])
    	 	->with(['message' => 'Contact saved']);
    }
    
    /**
     * Load page to update an contact
     * 
     * @param Request $request
     * @param unknown $contact_id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getUpdateContact(Request $request, $contact_id)
    {
    	$contact = Contact::find($contact_id);
    	$lookup_titles = LookupUtil::retrieveLookupTitles();
    	$lookup_marital_statuses = LookupUtil::retrieveLookupMaritalStatuses();
    	if (Util::isValidRequestVariable($request->model_name))
    	{
    		$model_name = $request->model_name;
    	}
    	else
    	{
    		$model_name = "none";
    	}
    	if (Util::isValidRequestVariable($request->model_id))
    	{
    		$model_id = $request->model_id;
    	}
    	else
    	{
    		$model_id = "none";
    	}
    	$model_view_route = $this->getModelViewRoute($model_name, $model_id);
    	$model_id_name = $this->getModelIdName($model_name);
    	$link_description = $this->getLinkDescription($model_name);
    	return view('contact.update-contact', [
    		'contact' => $contact, 
    		'lookup_titles' => $lookup_titles, 
    		'lookup_marital_statuses' => $lookup_marital_statuses,
    		'model_name' => $model_name,
    		'model_id' => $model_id,
    		'model_view_route' => $model_view_route,
    		'model_id_name' => $model_id_name,
    		'link_description' => $link_description
    	]);
    }
    
    /**
     * Update an contact
     * 
     * @param Request $request
     * @param unknown $contact_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDoUpdateContact(Request $request, $contact_id)
    {
//     	$this->validate($request, [
//     		'firstname' => 'required',
//     		'home-tel' => 'numeric|min:10|max:10',
//     		'work-tel' => 'numeric|min:10|max:10',
//     		'cell-no' => 'numeric|min:10|max:10',
//     		'personal-email' => 'email',
//     		'work-email' => 'email',
//     		'id-number' => 'numeric|min:13|max:13'
//     	]);
    	$validator = Validator::make($request->all(), [
    		'firstname' => 'required',
    		'home-tel' => 'numeric|min:10|max:10',
    		'work-tel' => 'numeric|min:10|max:10',
    		'cell-no' => 'numeric|min:10|max:10',
    		'personal-email' => 'email',
    		'work-email' => 'email',
    		'id-number' => 'numeric|min:13|max:13'
    	]);
    	
    	if ($validator->fails()) {
    		return redirect()
	    		->route('update-contact', ['contact_id' => $contact_id])
	    		->withErrors($validator)
	    		->withInput()
    			->with('model_id', $request->model_id)
    			->with('model_name', $request->model_name);
    	}
    	$user = Auth::user();
    	$contact = Contact::find($contact_id);
    	$contact = $this->populateContactObject($request, $contact);
    	$contact->updated_by_id = $user->id;
    	$contact->save();
    	
    	/* Get applicable model and attach */
    	if (Util::isValidRequestVariable($request->model_name))
    	{
    		$model_name = $request->model_name;
    	}
    	else
    	{
    		$model_name = ModelConstants::NONE_MODEL_NAME;
    	}
    	if (Util::isValidRequestVariable($request->model_id))
    	{
    		$model_id = $request->model_id;
    	}
    	else
    	{
    		$model_id = 0;
    	}
    	
    	return redirect()->action('ContactController@getViewContact', [
    		'contact_Id' => $contact->id,
   			'model_name' => $model_name,
   			'model_id' => $model_id
    	])
    	->with(['message' => 'Contact updated']);
    }
    
    /**
     * Load the page to view an contact
     * 
     * @param Request $request
     * @param unknown $contact_id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getViewContact(Request $request, $contact_id)
    {
    	/* Get applicable model */
    	if (Util::isValidRequestVariable($request->model_name))
    	{
    		$model_name = $request->model_name;
    	}
    	else
    	{
    		$model_name = ModelConstants::NONE_MODEL_NAME;
    	}
    	if (Util::isValidRequestVariable($request->model_id))
    	{
    		$model_id = $request->model_id;
    	}
    	else
    	{
    		$model_id = 0;
    	}
    	
    	/* Prepare some data */
    	$contact = Contact::find($contact_id);
    	$model_view_route = $this->getModelViewRoute($model_name, $model_id);
    	$model_id_name = $this->getModelIdName($model_name);
    	$link_description = $this->getLinkDescription($model_name);
    	
    	/* Return to view */
    	return view('contact.view-contact', [
    		'contact' => $contact, 
    		'model_view_route' => $model_view_route,
    		'model_id' => $model_id,
    		'model_id_name' => $model_id_name,
    		'link_description' => $link_description
    	]);
    }
    
    /**
     * Populate the contact object with values from the request
     * 
     * @param Request $request
     * @param unknown $contact
     * @return Contact
     */
    private function populateContactObject(Request $request, $contact)
    {
    	if (Util::isValidRequestVariable($request->title_id))
    	{
    		$contact->title_id = $request->title_id;
    	}
    	if (Util::isValidRequestVariable($request->firstname))
    	{
    		$contact->firstname = $request->firstname;
    	}
    	if (Util::isValidRequestVariable($request->surname))
    	{
    		$contact->surname = $request->surname;
    	}
    	if (Util::isValidRequestVariable($request->home_tel_no))
    	{
    		$contact->home_tel_no = $request->home_tel_no;
    	}
    	if (Util::isValidRequestVariable($request->work_tel_no))
    	{
    		$contact->work_tel_no = $request->work_tel_no;
    	}
    	if (Util::isValidRequestVariable($request->cell_no))
    	{
    		$contact->cell_no = $request->cell_no;
    	}
    	if (Util::isValidRequestVariable($request->fax_no))
    	{
    		$contact->fax_no = $request->fax_no;
    	}
    	if (Util::isValidRequestVariable($request->personal_email))
    	{
    		$contact->personal_email = $request->personal_email;
    	}
    	if (Util::isValidRequestVariable($request->work_email))
    	{
    		$contact->work_email = $request->work_email;
    	}
    	if (Util::isValidRequestVariable($request->id_number))
    	{
    		$contact->id_number = $request->id_number;
    	}
    	if (Util::isValidRequestVariable($request->passport_number))
    	{
    		$contact->passport_number = $request->passport_number;
    	}
    	if (Util::isValidRequestVariable($request->marital_status_id))
    	{
    		$contact->marital_status_id = $request->marital_status_id;
    	}
    	if (Util::isValidRequestVariable($request->tax_number))
    	{
    		$contact->tax_number = $request->tax_number;
    	}
    	if (Util::isValidRequestVariable($request->sa_citizen))
    	{
    		$contact->sa_citizen = $request->sa_citizen;
    	}
    	return $contact;
    }
    
    /**
     * Use the applicable model, and attach the contact to the model as a many to many relationship
     * 
     * @param \Illuminate\Support\Facades\Request $request
     * @param Contact $contact
     */
    private function attachContactToModel($request, $contact, $model_name, $model_id)
    {
    	if ($model_name === ModelConstants::ATTORNEY_MODEL_NAME)
    	{
    		$attorney = Attorney::find($model_id);
    		$attorney->contacts()->attach($contact);
    	}
    	else if ($model_name === ModelConstants::BANK_MODEL_NAME)
    	{
    		$contractor = Bank::find($model_id);
    		$contractor->contacts()->attach($contact);
    	}
    	else if ($model_name === ModelConstants::CONTRACTOR_MODEL_NAME)
    	{
    		$contractor = Contractor::find($model_id);
    		$contractor->contacts()->attach($contact);
    	}
    	else if ($model_name === ModelConstants::ESTATE_AGENT_MODEL_NAME)
    	{
    		$estate_agent = EstateAgent::find($model_id);
    		$estate_agent->contacts()->attach($contact);
    	}
    	//Do the other models here
    }
    
    /**
     * If the user is on the contact view page, after adding or updating a contact, this will determine
     * to which page they will return to when clicking on the Back button on the contact view page.
     * 
     * It is possible to add contacts from the main Contacts menu, but also from the view screens for
     * Attornies, Estate Agents, Contractors and Banks, so you want to return to the correct screen.
     * 
     * @param unknown $model_name
     * @param unknown $model_id
     * @return string
     */
    private function getModelViewRoute($model_name, $model_id)
    {
    	if ($model_name === ModelConstants::ATTORNEY_MODEL_NAME)
    	{
    		return "view-attorney";
    	}
    	else if ($model_name === ModelConstants::BANK_MODEL_NAME)
    	{
    		return "view-bank";
    	}
    	else if ($model_name === ModelConstants::CONTRACTOR_MODEL_NAME)
    	{
    		return "view-contractor";
    	}
    	else if ($model_name === ModelConstants::ESTATE_AGENT_MODEL_NAME)
    	{
    		return "view-estate-agent";
    	}
    	else if ($model_name === ModelConstants::PROPERTY_FLIP_MODEL_NAME)
    	{
    		return "view-property-flip";
    	}
    	else
    	{
    		return "search-contact";
    	}
    }
    
    private function getModelIdName($model_name)
    {
    	if ($model_name === ModelConstants::ATTORNEY_MODEL_NAME)
    	{
    		return "attorney_id";
    	}
    	else if ($model_name === ModelConstants::BANK_MODEL_NAME)
    	{
    		return "bank_id";
    	}
    	else if ($model_name === ModelConstants::CONTRACTOR_MODEL_NAME)
    	{
    		return "contractor_id";
    	}
    	else if ($model_name === ModelConstants::ESTATE_AGENT_MODEL_NAME)
    	{
    		return "estate_agent_id";
    	}
    	else if ($model_name === ModelConstants::PROPERTY_FLIP_MODEL_NAME)
    	{
    		return "property_flip_id";
    	}
    	else
    	{
    		return "search-contact";
    	}
    }
    
    private function getLinkDescription($model_name)
    {
    	if ($model_name === ModelConstants::ATTORNEY_MODEL_NAME)
    	{
    		return "View Attorney";
    	}
    	else if ($model_name === ModelConstants::BANK_MODEL_NAME)
    	{
    		return "View Bank";
    	}
    	else if ($model_name === ModelConstants::CONTRACTOR_MODEL_NAME)
    	{
    		return "View Contractor";
    	}
    	else if ($model_name === ModelConstants::ESTATE_AGENT_MODEL_NAME)
    	{
    		return "View Estate Agent";
    	}
    	else if ($model_name === ModelConstants::PROPERTY_FLIP_MODEL_NAME)
    	{
    		return "View Property Flip";
    	}
    	else
    	{
    		return "Search Contact";
    	}
    }
    
}
