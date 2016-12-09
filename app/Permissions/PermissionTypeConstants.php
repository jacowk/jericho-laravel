<?php
namespace jericho\Permissions;

/**
 * This class contains constants for all permission types. The purpose of permission types is 
 * to break all permissions into groups for managability.
 * 
 * @author Jaco Koekemoer
 * Date: 2016-12-09
 *
 */
class PermissionTypeConstants
{
	/* Permissions related to Users, Roles, Permissions and Auditing */
	const ADMIN_PERMISSIONS = 'Admin Permissions';
	/* Permissions related to any report */
	const REPORT_PERMISSIONS = 'Report Permissions';
	/* Permissions related to Attorneys, Contractors, Estate Agents and Banks */
	const THIRD_PARTY_PERMISSIONS = 'Third Party Permissions';
	/* Lookup permissions are for all items under the Setup menu, and are related to setting up items that are used
	 * in dropdown boxes throughout the system. */
	const LOOKUP_PERMISSIONS = 'Lookup Permissions';
	/* Property permissions are any permission that relates to properties and property flips */
	const PROPERTY_PERMISSIONS = 'Property Permissions';
	/* Global permissions are not limited to any role or user. All roles should have access to these */
	const GLOBAL_PERMISSIONS = 'Global Permissions';
}