<?php
namespace jericho\Permissions;

/**
 * Constants relating to all permissions. This class should have all constants that are in the "permissions"
 * table in the database. THE permission to SEARCH and the permission to VIEW is synonymous in the system, 
 * and is not specified as seperate permissions at the time of first development.
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-05
 */
class PermissionConstants
{
	const ADD_ACCOUNT = 'Add Account';
	const UPDATE_ACCOUNT = 'Update Account';
	const VIEW_ACCOUNT = 'View Account';
	const ADD_AREA = 'Add Area';
	const UPDATE_AREA = 'Update Area';
	const VIEW_AREA = 'View Area';
	const ADD_ATTORNEY = 'Add Attorney';
	const UPDATE_ATTORNEY = 'Update Attorney';
	const VIEW_ATTORNEY = 'View Attorney';
	const ADD_BANK = 'Add Bank';
	const UPDATE_BANK = 'Update Bank';
	const VIEW_BANK = 'View Bank';
	const ADD_CONTACT = 'Add Contact';
	const UPDATE_CONTACT = 'Update Contact';
	const VIEW_CONTACT = 'View Contact';
	const ADD_CONTRACTOR = 'Add Contractor';
	const UPDATE_CONTRACTOR = 'Update Contractor';
	const VIEW_CONTRACTOR = 'View Contractor';
	const ADD_CONTRACTOR_SERVICE = 'Add Contractor Service';
	const UPDATE_CONTRACTOR_SERVICE = 'Update Contractor Service';
	const VIEW_CONTRACTOR_SERVICE = 'View Contractor Service';
	const ADD_DIARY_ITEM = 'Add Diary Item';
	const UPDATE_DIARY_ITEM = 'Update Diary Item';
	const VIEW_DIARY_ITEM = 'View Diary Item';
	const ADD_DIARY_ITEM_COMMENT = 'Add Diary Item Comment';
	const UPDATE_DIARY_ITEM_COMMENT = 'Update Diary Item Comment';
	const VIEW_DIARY_ITEM_COMMENT = 'View Diary Item Comment';
	const ADD_DOCUMENT = 'Add Document';
	const UPDATE_DOCUMENT = 'Update Document';
	const VIEW_DOCUMENT = 'View Document';
	const ADD_ESTATE_AGENT = 'Add Estate Agent';
	const UPDATE_ESTATE_AGENT = 'Update Estate Agent';
	const VIEW_ESTATE_AGENT = 'View Estate Agent';
	const ADD_FOLLOWUP_ITEM = 'Add Followup Item';
	const UPDATE_FOLLOWUP_ITEM = 'Update Followup Item';
	const VIEW_FOLLOWUP_ITEM = 'View Followup Item';
	const ADD_GREATER_AREA = 'Add Greater Area';
	const UPDATE_GREATER_AREA = 'Update Greater Area';
	const VIEW_GREATER_AREA = 'View Greater Area';
	const ADD_ATTORNEY_TYPE = 'Add Attorney Type';
	const UPDATE_ATTORNEY_TYPE = 'Update Attorney Type';
	const VIEW_ATTORNEY_TYPE = 'View Attorney Type';
	const ADD_CONTRACTOR_TYPE = 'Add Contractor Type';
	const UPDATE_CONTRACTOR_TYPE = 'Update Contractor Type';
	const VIEW_CONTRACTOR_TYPE = 'View Contractor Type';
	const ADD_DOCUMENT_TYPE = 'Add Document Type';
	const UPDATE_DOCUMENT_TYPE = 'Update Document Type';
	const VIEW_DOCUMENT_TYPE = 'View Document Type';
	const ADD_ESTATE_AGENT_TYPE = 'Add Estate Agent Type';
	const UPDATE_ESTATE_AGENT_TYPE = 'Update Estate Agent Type';
	const VIEW_ESTATE_AGENT_TYPE = 'View Estate Agent Type';
	const ADD_MARITAL_STATUS = 'Add Marital Status';
	const UPDATE_MARITAL_STATUS = 'Update Marital Status';
	const VIEW_MARITAL_STATUS = 'View Marital Status';
	const ADD_TITLE = 'Add Title';
	const UPDATE_TITLE = 'Update Title';
	const VIEW_TITLE = 'View Title';
	const ADD_TRANSACTION_TYPE = 'Add Transaction Type';
	const UPDATE_TRANSACTION_TYPE = 'Update Transaction Type';
	const VIEW_TRANSACTION_TYPE = 'View Transaction Type';
	const ADD_MILESTONE = 'Add Milestone';
	const UPDATE_MILESTONE = 'Update Milestone';
	const VIEW_MILESTONE = 'View Milestone';
	const ADD_MILESTONE_TYPE = 'Add Milestone Type';
	const UPDATE_MILESTONE_TYPE = 'Update Milestone Type';
	const VIEW_MILESTONE_TYPE = 'View Milestone Type';
	const ADD_NOTE = 'Add Note';
	const UPDATE_NOTE = 'Update Note';
	const VIEW_NOTE = 'View Note';
	const ADD_PERMISSION = 'Add Permission';
	const UPDATE_PERMISSION = 'Update Permission';
	const VIEW_PERMISSION = 'View Permission';
	const ADD_PROPERTY = 'Add Property';
	const UPDATE_PROPERTY = 'Update Property';
	const VIEW_PROPERTY = 'View Property';
	const ADD_PROPERTY_FLIP = 'Add Property Flip';
	const UPDATE_PROPERTY_FLIP = 'Update Property Flip';
	const VIEW_PROPERTY_FLIP = 'View Property Flip';
	const ADD_PROPERTY_TYPE = 'Add Property Type';
	const UPDATE_PROPERTY_TYPE = 'Update Property Type';
	const VIEW_PROPERTY_TYPE = 'View Property Type';
	const ADD_ROLE = 'Add Role';
	const UPDATE_ROLE = 'Update Role';
	const VIEW_ROLE = 'View Role';
	const ADD_SUBURB = 'Add Suburb';
	const UPDATE_SUBURB = 'Update Suburb';
	const VIEW_SUBURB = 'View Suburb';
	const ADD_TRANSACTION = 'Add Transaction';
	const UPDATE_TRANSACTION = 'Update Transaction';
	const VIEW_TRANSACTION = 'View Transaction';
	const ADD_USER = 'Add User';
	const UPDATE_USER = 'Update User';
	const VIEW_USER = 'View User';
	const LINK_ATTORNEY_CONTACT = 'Link Attorney Contact';
	const DELETE_ATTORNEY_CONTACT_LINK = 'Delete Attorney Contact Link';
	const VIEW_PROPERTY_FLIP_ATTORNEYS = 'View Property Flip Attorneys';
	const LINK_ESTATE_AGENT_CONTACT = 'Link Estate Agent Contact';
	const DELETE_ESTATE_AGENT_CONTACT_LINK = 'Delete Estate Agent Contact Link';
	const VIEW_PROPERTY_FLIP_ESTATE_AGENTS = 'View Property Flip Estate Agents';
	const LINK_CONTRACTOR_CONTACT = 'Link Contractor Contact';
	const DELETE_CONTRACTOR_CONTACT_LINK = 'Delete Contractor Contact Link';
	const VIEW_PROPERTY_FLIP_CONTRACTORS = 'View Property Flip Contractors';
	const LINK_INVESTOR_CONTACT = 'Link Investor Contact';
	const DELETE_INVESTOR_CONTACT_LINK = 'Delete Investor Contact Link';
	const VIEW_PROPERTY_FLIP_INVESTORS = 'View Property Flip Investors';
	const LINK_BANK_CONTACT = 'Link Bank Contact';
	const DELETE_BANK_CONTACT_LINK = 'Delete Bank Contact Link';
	const VIEW_PROPERTY_FLIP_BANKS = 'View Property Flip Banks';
	const DOWNLOAD_DOCUMENT = 'Download Document';
// 	const SELF_ALLOCATE_DIARY_ITEM = 'Self Allocate Diary Item';
	const VIEW_LEADS_TO_SALES_REPORT = 'View Leads To Sales Report';
	const VIEW_AMOUNT_OF_LEADS_ACTIONED_REPORT = 'View Amount Of Leads Actioned Report';
	const VIEW_LEADS_PER_AREA_REPORT = 'View Leads Per Area Report';
	const VIEW_PROFIT_AND_LOSS_BY_DATE_REPORT = 'View Profit And Loss By Date Report';
	const VIEW_TOTALS_PER_STATUS_REPORT = 'View Totals Per Status Report';
	const VIEW_SUMMARY_OF_TOTALS_REPORT = 'View Summary Of Totals Report'; 
	const VIEW_AUDIT_TRAIL = 'View Audit Trail';
	const VIEW_AUDIT_FIELDS = 'View Audit Fields'; /* Refering to create and update fields */
	const ADD_ISSUE = 'Add Issue';
	const UPDATE_ISSUE = 'Update Issue';
	const VIEW_ISSUE = 'View Issue';
	const ADD_ISSUE_COMMENT = 'Add Issue Comment';
	const UPDATE_ISSUE_COMMENT = 'Update Issue Comment';
	const VIEW_ISSUE_COMMENT = 'View Issue Comment';
	const RESET_PASSWORD = 'Reset Password';
	const UPDATE_PROFILE = 'Update Profile';
}