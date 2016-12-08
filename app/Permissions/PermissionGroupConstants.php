<?php
namespace jericho\Permissions;

use jericho\Permissions\PermissionConstants;

/**
 * The following class attempts to group SOME permissions into groups, for bulk assign or revoke.
 * 
 * @author Jaco Koekemoer
 * Date: 2016-12-08
 *
 */
class PermissionGoupConstants
{
	const THIRD_PARTY_PERMISSIONS = [
			PermissionConstants::ADD_ATTORNEY,
			PermissionConstants::UPDATE_ATTORNEY,
			PermissionConstants::VIEW_ATTORNEY,
			
			PermissionConstants::ADD_BANK,
			PermissionConstants::UPDATE_BANK,
			PermissionConstants::VIEW_BANK,
			
			PermissionConstants::ADD_CONTACT,
			PermissionConstants::UPDATE_CONTACT,
			PermissionConstants::VIEW_CONTACT,
			
			PermissionConstants::ADD_CONTRACTOR,
			PermissionConstants::UPDATE_CONTRACTOR,
			PermissionConstants::VIEW_CONTRACTOR,
			
			PermissionConstants::ADD_ESTATE_AGENT,
			PermissionConstants::UPDATE_ESTATE_AGENT,
			PermissionConstants::VIEW_ESTATE_AGENT
	];
	
	const SETUP_PERMISSIONS = [
			PermissionConstants::ADD_ACCOUNT,
			PermissionConstants::UPDATE_ACCOUNT,
			PermissionConstants::VIEW_ACCOUNT,
			
			PermissionConstants::ADD_GREATER_AREA,
			PermissionConstants::UPDATE_GREATER_AREA,
			PermissionConstants::VIEW_GREATER_AREA,
			
			PermissionConstants::ADD_AREA,
			PermissionConstants::UPDATE_AREA,
			PermissionConstants::VIEW_AREA,
			
			PermissionConstants::ADD_SUBURB,
			PermissionConstants::UPDATE_SUBURB,
			PermissionConstants::VIEW_SUBURB,
			
			PermissionConstants::ADD_ATTORNEY_TYPE,
			PermissionConstants::UPDATE_ATTORNEY_TYPE,
			PermissionConstants::VIEW_ATTORNEY_TYPE,
			
			PermissionConstants::ADD_CONTRACTOR_TYPE,
			PermissionConstants::UPDATE_CONTRACTOR_TYPE,
			PermissionConstants::VIEW_CONTRACTOR_TYPE,
			
			PermissionConstants::ADD_DOCUMENT_TYPE,
			PermissionConstants::UPDATE_DOCUMENT_TYPE,
			PermissionConstants::VIEW_DOCUMENT_TYPE,
			
			PermissionConstants::ADD_ESTATE_AGENT_TYPE,
			PermissionConstants::UPDATE_ESTATE_AGENT_TYPE,
			PermissionConstants::VIEW_ESTATE_AGENT_TYPE
	];
}