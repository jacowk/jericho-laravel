<?php
namespace jericho\Util;

use jericho\LookupMilestoneType;
use jericho\LookupEstateAgentType;
use jericho\LookupAttorneyType;
use jericho\LookupContractorType;
use jericho\LookupDocumentType;
use jericho\LookupPropertyType;
use jericho\LookupTitle;
use jericho\LookupMaritalStatus;
use jericho\GreaterArea;
use jericho\Area;
use jericho\Suburb;
use jericho\Contact;
use jericho\FinanceStatus;
use jericho\SellerStatus;
use jericho\User;
use jericho\DiaryItemStatus;
use jericho\Account;
use jericho\LookupTransactionType;
use jericho\Attorney;
use jericho\EstateAgent;
use jericho\Contractor;
use jericho\Bank;
use jericho\Role;
use jericho\Permission;
use jericho\Util\Util;
use jericho\LookupIssueComponent;
use jericho\LookupIssueCategory;
use jericho\LookupIssueSeverity;
use jericho\IssueStatus;
use DB;

/**
 * This util class is used to create key => value pairs from tables that are used in drop down boxes in the views 
 * 
 * @author Jaco Koekemoer
 * @deprecated
 *
 */
class LookupUtil
{
// 	public static function retrieveLookupMilestoneTypes()
// 	{
// 		$lookup_milestone_types = LookupMilestoneType::all();
// 		$milestone_types = array();
// 		$milestone_types[-1] = "Select Milestone Type";
// 		foreach($lookup_milestone_types as $milestone_type)
// 		{
// 			$milestone_types[$milestone_type->id] = $milestone_type->description;
// 		}
// 		return $milestone_types;
// 	}
	
// 	public static function retrieveLookupEstateAgentTypes()
// 	{
// 		$lookup_estate_agent_types = LookupEstateAgentType::all();
// 		$estate_agent_types = array();
// 		$estate_agent_types[-1] = "Select Estate Agent Type";
// 		foreach($lookup_estate_agent_types as $estate_agent_type)
// 		{
// 			$estate_agent_types[$estate_agent_type->id] = $estate_agent_type->description;
// 		}
// 		return $estate_agent_types;
// 	}
	
// 	public static function retrieveLookupAttorneyTypes()
// 	{
// 		$lookup_attorney_types = LookupAttorneyType::all();
// 		$attorney_types = array();
// 		$attorney_types[-1] = "Select Attorney Type";
// 		foreach($lookup_attorney_types as $attorney_type)
// 		{
// 			$attorney_types[$attorney_type->id] = $attorney_type->description;
// 		}
// 		return $attorney_types;
// 	}
	
// 	public static function retrieveLookupContractorTypes()
// 	{
// 		$lookup_contractor_types = LookupContractorType::all();
// 		$contractor_types = array();
// 		$contractor_types[-1] = "Select Contractor Type";
// 		foreach($lookup_contractor_types as $contractor_type)
// 		{
// 			$contractor_types[$contractor_type->id] = $contractor_type->description;
// 		}
// 		return $contractor_types;
// 	}
	
// 	public static function retrieveLookupDocumentTypes()
// 	{
// 		$lookup_document_types = LookupDocumentType::all();
// 		$document_types = array();
// 		$document_types[-1] = "Select Document Type";
// 		foreach($lookup_document_types as $document_type)
// 		{
// 			$document_types[$document_type->id] = $document_type->description;
// 		}
// 		return $document_types;
// 	}
	
// 	public static function retrieveLookupTitles()
// 	{
// 		$lookup_titles = LookupTitle::all();
// 		$titles = array();
// 		$titles[-1] = "Select Title";
// 		foreach($lookup_titles as $title)
// 		{
// 			$titles[$title->id] = $title->description;
// 		}
// 		return $titles;
// 	}
	
// 	public static function retrieveLookupMaritalStatuses()
// 	{
// 		$lookup_marital_statuses = LookupMaritalStatus::all();
// 		$marital_statuses = array();
// 		$marital_statuses[-1] = "Select Marital Status";
// 		foreach($lookup_marital_statuses as $marital_status)
// 		{
// 			$marital_statuses[$marital_status->id] = $marital_status->description;
// 		}
// 		return $marital_statuses;
// 	}
	
// 	public static function retrieveGreaterAreasLookup() //GreaterAreaLookupRetriever
// 	{
// 		$table_greater_areas = GreaterArea::orderBy('name', 'asc')->get();
// 		$greater_areas = array();
// 		$greater_areas[-1] = "Select Greater Area";
// 		foreach($table_greater_areas as $greater_area)
// 		{
// 			$greater_areas[$greater_area->id] = $greater_area->name;
// 		}
// 		return $greater_areas;
// 	}
	
// 	public static function retrieveAreasLookup() //AreaLookupRetriever
// 	{
// 		$table_areas = Area::orderBy('name', 'asc')->get();
// 		$areas = array();
// 		$areas[-1] = "Select Area";
// 		foreach($table_areas as $area)
// 		{
// 			$areas[$area->id] = $area->name;
// 		}
// 		return $areas;
// 	}
	
// 	public static function retrieveSuburbsLookup() //SuburbLookupRetriever
// 	{
// 		$table_suburbs = Suburb::all();
// 		$suburbs = array();
// 		$suburbs[-1] = "Select Suburb";
// 		foreach($table_suburbs as $suburb)
// 		{
// 			$suburbs[$suburb->id] = $suburb->name;
// 		}
// 		return $suburbs;
// 	}
	
// 	public static function retrieveContactsLookup() //ContactLookupRetriever
// 	{
// 		$table_contacts = Contact::all();
// 		$contacts = array();
// 		$contacts[-1] = "Select Contact";
// 		foreach($table_contacts as $contact)
// 		{
// 			$contacts[$contact->id] = $contact->firstname . " " . $contact->surname;
// 		}
// 		return $contacts;
// 	}
	
// 	public static function retrieveFinanceStatusLookup() //FinanceStatusLookupRetriever
// 	{
// 		$table_finance_statuses = FinanceStatus::all();
// 		$finance_statuses = array();
// 		$finance_statuses[-1] = "Select Finance Status";
// 		foreach($table_finance_statuses as $finance_status)
// 		{
// 			$finance_statuses[$finance_status->id] = $finance_status->description;
// 		}
// 		return $finance_statuses;
// 	}
	
// 	public static function retrieveDiaryItemStatusLookup() //DiaryItemStatusLookupRetriever
// 	{
// 		$table_diary_item_statuses = DiaryItemStatus::all();
// 		$diary_item_statuses = array();
// 		$diary_item_statuses[-1] = "Select Diary Item Status";
// 		foreach($table_diary_item_statuses as $diary_item_status)
// 		{
// 			$diary_item_statuses[$diary_item_status->id] = $diary_item_status->description;
// 		}
// 		return $diary_item_statuses;
// 	}
	
// 	public static function retrieveSellerStatusLookup() //SellerStatusLookupRetriever
// 	{
// 		$table_seller_statuses = SellerStatus::all();
// 		$seller_statuses = array();
// 		$seller_statuses[-1] = "Select Seller Status";
// 		foreach($table_seller_statuses as $seller_status)
// 		{
// 			$seller_statuses[$seller_status->id] = $seller_status->description;
// 		}
// 		return $seller_statuses;
// 	}
	
// 	public static function retrieveUsersLookup() //UserLookupRetriever
// 	{
// 		$table_users = User::all();
// 		$users = array();
// 		$users[-1] = "Select User";
// 		foreach($table_users as $user)
// 		{
// 			$users[$user->id] = $user->firstname . " " . $user->surname;
// 		}
// 		return $users;
// 	}
	
// 	public static function retrieveLookupAccounts() //AccountLookupRetriever
// 	{
// 		$lookup_accounts = Account::all();
// 		$accounts = array();
// 		$accounts[-1] = "Select Account";
// 		foreach($lookup_accounts as $account)
// 		{
// 			$accounts[$account->id] = $account->name;
// 		}
// 		return $accounts;
// 	}
	
// 	public static function retrieveLookupTransactionTypes() //TransactionTypeLookupRetriever
// 	{
// 		$lookup_transaction_types = LookupTransactionType::all();
// 		$transaction_types = array();
// 		$transaction_types[-1] = "Select Transaction Type";
// 		foreach($lookup_transaction_types as $transaction_type)
// 		{
// 			$transaction_types[$transaction_type->id] = $transaction_type->description;
// 		}
// 		return $transaction_types;
// 	}
	
// 	public static function retrieveLookupPropertyTypes() //PropertyTypeLookupRetriever
// 	{
// 		$lookup_property_types = LookupPropertyType::all();
// 		$property_types = array();
// 		$property_types[-1] = "Select Property Type";
// 		foreach($lookup_property_types as $property_type)
// 		{
// 			$property_types[$property_type->id] = $property_type->description;
// 		}
// 		return $property_types;
// 	}
	
	/* Link attorneys to property flips */
// 	public static function retrieveAttorneys() //AttorneyLookupRetriever
// 	{
// 		$lookup_attorneys = Attorney::all();
// 		$attorneys = array();
// 		$attorneys[-1] = "Select Attorney";
// 		foreach($lookup_attorneys as $attorney)
// 		{
// 			$attorneys[$attorney->id] = $attorney->name;
// 		}
// 		return $attorneys;
// 	}
	
// 	public static function retrieveAttorneyContacts($attorney_id) //AttorneyContactLookupRetriever
// 	{
// 		$lookup_attorney_contacts = DB::table('attorney_contact')
// 			->join('contacts', 'contacts.id', '=' ,'attorney_contact.contact_id')
// 			->where('attorney_contact.attorney_id', '=', $attorney_id)
// 			->select('contacts.id',
// 					'contacts.firstname',
// 					'contacts.surname')
// 					->get();
// 		$attorney_contacts = array();
// 		$attorney_contacts[-1] = "Select Attorney Contact";
// 		foreach($lookup_attorney_contacts as $attorney_contact)
// 		{
// 			$attorney_contacts[$attorney_contact->id] = $attorney_contact->firstname . " " . $attorney_contact->surname;
// 		}
// 		return $attorney_contacts;
// 	}
	
// 	public static function retrieveAttorneyContactsAjax($attorney_id) //AttorneyContactAjaxLookupRetriever
// 	{
// 		$lookup_attorney_contacts = DB::table('attorney_contact')
// 			->join('contacts', 'contacts.id', '=' ,'attorney_contact.contact_id')
// 			->where('attorney_contact.attorney_id', '=', $attorney_id)
// 			->select('contacts.id',
// 					'contacts.firstname',
// 					'contacts.surname')
// 					->get();
// 		$attorney_contacts = array();
// 		foreach($lookup_attorney_contacts as $attorney_contact)
// 		{
// 			$attorney_contacts[$attorney_contact->id] = $attorney_contact->firstname . " " . $attorney_contact->surname;
// 		}
// 		return $attorney_contacts;
// 	}
	
	/* Link estate agents to property flips */
// 	public static function retrieveEstateAgents()
// 	{
// 		$lookup_estate_agents = EstateAgent::all();
// 		$estate_agents = array();
// 		$estate_agents[-1] = "Select Estate Agent";
// 		foreach($lookup_estate_agents as $estate_agent)
// 		{
// 			$estate_agents[$estate_agent->id] = $estate_agent->name;
// 		}
// 		return $estate_agents;
// 	}
	
// 	public static function retrieveContactEstateAgentsAjax($estate_agent_id) //ContactEstateAgentAjaxLookupRetriever
// 	{
// 		$lookup_contact_estate_agents = DB::table('contact_estate_agent')
// 			->join('contacts', 'contacts.id', '=' ,'contact_estate_agent.contact_id')
// 			->where('contact_estate_agent.estate_agent_id', '=', $estate_agent_id)
// 			->select('contacts.id',
// 					'contacts.firstname',
// 					'contacts.surname')
// 					->get();
// 		$contact_estate_agents = array();
// 		foreach($lookup_contact_estate_agents as $contact_estate_agent)
// 		{
// 			$contact_estate_agents[$contact_estate_agent->id] = $contact_estate_agent->firstname . " " . $contact_estate_agent->surname;
// 		}
// 		return $contact_estate_agents;
// 	}
	
	/* Link contractors to property flips */
// 	public static function retrieveContractors() //ContractorLookupRetriever
// 	{
// 		$lookup_contractors = Contractor::all();
// 		$contractors = array();
// 		$contractors[-1] = "Select Contractor";
// 		foreach($lookup_contractors as $contractor)
// 		{
// 			$contractors[$contractor->id] = $contractor->name;
// 		}
// 		return $contractors;
// 	}
	
// 	public static function retrieveContactContractorsAjax($contractor_id) //ContactContractorAjaxLookupRetriever
// 	{
// 		$lookup_contact_contractors = DB::table('contact_contractor')
// 			->join('contacts', 'contacts.id', '=' ,'contact_contractor.contact_id')
// 			->where('contact_contractor.contractor_id', '=', $contractor_id)
// 			->select('contacts.id',
// 					'contacts.firstname',
// 					'contacts.surname')
// 					->get();
// 		$contact_contractors = array();
// 		foreach($lookup_contact_contractors as $contact_contractor)
// 		{
// 			$contact_contractors[$contact_contractor->id] = $contact_contractor->firstname . " " . $contact_contractor->surname;
// 		}
// 		return $contact_contractors;
// 	}
	
// 	public static function retrieveContactContractorTypesAjax($contractor_id) //ContractorServiceTypeAjaxLookupRetriever
// 	{
// 		$lookup_contact_contractors = DB::table('contractor_services')
// 				->join('lookup_contractor_types', 'lookup_contractor_types.id', '=', 'contractor_services.contractor_type_id')
// 				->where('contractor_services.contractor_id', '=', $contractor_id)
// 				->select('lookup_contractor_types.id', 'lookup_contractor_types.description')
// 				->get();
// 		$contact_contractors = array();
// 		foreach($lookup_contact_contractors as $contact_contractor)
// 		{
// 			$contact_contractors[$contact_contractor->id] = $contact_contractor->description;
// 		}
// 		return $contact_contractors;
// 	}
	
	/* Link banks to property flips */
// 	public static function retrieveBanks() //BankLookupRetriever
// 	{
// 		$lookup_banks = Bank::all();
// 		$banks = array();
// 		$banks[-1] = "Select Bank";
// 		foreach($lookup_banks as $bank)
// 		{
// 			$banks[$bank->id] = $bank->name;
// 		}
// 		return $banks;
// 	}
	
// 	public static function retrieveBankContactsAjax($bank_id) //BankContactAjaxLookupRetriever
// 	{
// 		$lookup_bank_contacts = DB::table('bank_contact')
// 				->join('contacts', 'contacts.id', '=' ,'bank_contact.contact_id')
// 				->where('bank_contact.bank_id', '=', $bank_id)
// 				->select('contacts.id',
// 						'contacts.firstname',
// 						'contacts.surname')
// 						->get();
// 		$bank_contacts = array();
// 		foreach($lookup_bank_contacts as $bank_contact)
// 		{
// 			$bank_contacts[$bank_contact->id] = $bank_contact->firstname . " " . $bank_contact->surname;
// 		}
// 		return $bank_contacts;
// 	}
	
	/* Roles for Checkboxes */
// 	public static function retrieveRolesForCheckboxes($existing_roles = null) //RolesForCheckboxesRetriever
// 	{
// 		$lookup_roles = Role::all();
// 		$roles = array();
// 		foreach($lookup_roles as $role)
// 		{
// 			$role_selected = false;
// 			if ($existing_roles)
// 			{
// 				foreach($existing_roles as $existing_role)
// 				{
// 					if ($role->id === $existing_role->id)
// 					{
// 						$role_selected = true;
// 						break;
// 					}
// 				}
// 			}
// 			$roles[$role->id] = array(
// 				"html_name" => Util::convertNameForForm($role->name),
// 				"name" => $role->name,
// 				"role_selected" => $role_selected
// 			);
// 		}
// 		return $roles;
// 	}
	
	/* Permissions for Checkboxes */
// 	public static function retrievePermissionsForCheckboxes($existing_permissions = null) //PermissionsForCheckboxesRetriever
// 	{
// 		$lookup_permissions = Permission::all();
// 		$permissions = array();
// 		foreach($lookup_permissions as $permission)
// 		{
// 			$permission_selected = false;
// 			if ($existing_permissions)
// 			{
// 				foreach($existing_permissions as $existing_permission)
// 				{
// 					if ($permission->id === $existing_permission->id)
// 					{
// 						$permission_selected = true;
// 						break;
// 					}
// 				}
// 			}
// 			$permissions[$permission->id] = array(
// 				"html_name" => Util::convertNameForForm($permission->name),
// 				"name" => $permission->name,
// 				"permission_selected" => $permission_selected
// 			);
// 		}
// 		return $permissions;
// 	}
	
	/* Issue Tracker Lookups */
// 	public static function retrieveLookupIssueComponents() //IssueComponentLookupRetriever
// 	{
// 		$lookup_issue_components = LookupIssueComponent::orderBy('description', 'asc')->get();
// 		$issue_components = array();
// 		$issue_components[-1] = "Select Issue Component";
// 		foreach($lookup_issue_components as $issue_component)
// 		{
// 			$issue_components[$issue_component->id] = $issue_component->description;
// 		}
// 		return $issue_components;
// 	}
	
// 	public static function retrieveLookupIssueCategories() //IssueCategoryLookupRetriever
// 	{
// 		$lookup_issue_categories = LookupIssueCategory::all();
// 		$issue_categories = array();
// 		$issue_categories[-1] = "Select Issue Category";
// 		foreach($lookup_issue_categories as $issue_category)
// 		{
// 			$issue_categories[$issue_category->id] = $issue_category->description;
// 		}
// 		return $issue_categories;
// 	}
	
// 	public static function retrieveLookupIssueSeverityList() //IssueSeverityLookupRetriever
// 	{
// 		$lookup_issue_severity_list = LookupIssueSeverity::all();
// 		$issue_severity_list = array();
// 		$issue_severity_list[-1] = "Select Issue Severity";
// 		foreach($lookup_issue_severity_list as $issue_severity)
// 		{
// 			$issue_severity_list[$issue_severity->id] = $issue_severity->description;
// 		}
// 		return $issue_severity_list;
// 	}
	
// 	public static function retrieveIssueStatusLookup() //IssueStatusLookupRetriever
// 	{
// 		$table_issue_statuses = IssueStatus::all();
// 		$issue_statuses = array();
// 		$issue_statuses[-1] = "Select Issue Status";
// 		foreach($table_issue_statuses as $issue_status)
// 		{
// 			$issue_statuses[$issue_status->id] = $issue_status->description;
// 		}
// 		return $issue_statuses;
// 	}
	
// 	public static function paginationSizeOptions() //PaginationSizeLookupRetriever
// 	{
// 		$pagination_size_options = array();
// 		$pagination_size_options[10] = 10;
// 		$pagination_size_options[20] = 20;
// 		$pagination_size_options[30] = 30;
// 		$pagination_size_options[50] = 50;
// 		return $pagination_size_options;
// 	}
	
// 	public static function retrieveSuburbsForAreaAjax($area_id) //SuburbAjaxLookupRetriever
// 	{
// 		$lookup_suburbs_for_area = Suburb::where('area_id', '=', $area_id)
// 									->select('suburbs.id', 'suburbs.name')
// 									->get();
// 		$suburbs_for_area = array();
// 		foreach($lookup_suburbs_for_area as $suburb)
// 		{
// 			$suburbs_for_area[$suburb->id] = $suburb->name;
// 		}
// 		return $suburbs_for_area;
// 	}
}