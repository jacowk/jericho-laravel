<?php
namespace jericho\Menus;

use jericho\Permissions\PermissionValidator;
use jericho\Permissions\PermissionConstants;

/**
 * This class is used to determine if a particular menu item should be displayed. Mainly, if a user does not
 * have the VIEW permission for a component, then the menu item for that item will not be displayed.
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-05
 *
 */
class MenuDisplayValidator
{
	/* Main Menu */
	public static function canDisplayPropertiesMenu()
	{
		return PermissionValidator::hasPermission(PermissionConstants::VIEW_PROPERTY);
	}
	
	/* Main Menu */
	public static function canDisplaySetupMenu()
	{
		return MenuDisplayValidator::canDisplayAccountsMenu() ||
			MenuDisplayValidator::canDisplayGreaterAreasMenu() ||
			MenuDisplayValidator::canDisplayAreasMenu() ||
			MenuDisplayValidator::canDisplaySuburbsMenu() ||
			MenuDisplayValidator::canDisplayAttorneyTypesMenu() ||
			MenuDisplayValidator::canDisplayContractorTypesMenu() ||
			MenuDisplayValidator::canDisplayEstateAgentTypesMenu() ||
			MenuDisplayValidator::canDisplayMaritalStatusesMenu() ||
			MenuDisplayValidator::canDisplayPropertyTypesMenu() ||
			MenuDisplayValidator::canDisplayMilestoneTypesMenu() ||
			MenuDisplayValidator::canDisplayTitlesMenu() ||
			MenuDisplayValidator::canDisplayTransactionTypesMenu();
	}
	
	/* Submenu of Setup menu */
	public static function canDisplayAccountsMenu()
	{
		return PermissionValidator::hasPermission(PermissionConstants::VIEW_ACCOUNT);
	}
	
	/* Submenu of Setup menu */
	public static function canDisplayGreaterAreasMenu()
	{
		return PermissionValidator::hasPermission(PermissionConstants::VIEW_GREATER_AREA);
	}
	
	/* Submenu of Setup menu */
	public static function canDisplayAreasMenu()
	{
		return PermissionValidator::hasPermission(PermissionConstants::VIEW_AREA);
	}
	
	/* Submenu of Setup menu */
	public static function canDisplaySuburbsMenu()
	{
		return PermissionValidator::hasPermission(PermissionConstants::VIEW_SUBURB);
	}
	
	/* Submenu of Setup menu */
	public static function canDisplayAttorneyTypesMenu()
	{
		return PermissionValidator::hasPermission(PermissionConstants::VIEW_ATTORNEY_TYPE);
	}
	
	/* Submenu of Setup menu */
	public static function canDisplayContractorTypesMenu()
	{
		return PermissionValidator::hasPermission(PermissionConstants::VIEW_CONTRACTOR_TYPE);
	}
	
	/* Submenu of Setup menu */
	public static function canDisplayEstateAgentTypesMenu()
	{
		return PermissionValidator::hasPermission(PermissionConstants::VIEW_ESTATE_AGENT_TYPE);
	}
	
	/* Submenu of Setup menu */
	public static function canDisplayMaritalStatusesMenu()
	{
		return PermissionValidator::hasPermission(PermissionConstants::VIEW_MARITAL_STATUS);
	}
	
	/* Submenu of Setup menu */
	public static function canDisplayPropertyTypesMenu()
	{
		return PermissionValidator::hasPermission(PermissionConstants::VIEW_PROPERTY_TYPE);
	}
	
	/* Submenu of Setup menu */
	public static function canDisplayMilestoneTypesMenu()
	{
		return PermissionValidator::hasPermission(PermissionConstants::VIEW_MILESTONE_TYPE);
	}
	
	/* Submenu of Setup menu */
	public static function canDisplayTitlesMenu()
	{
		return PermissionValidator::hasPermission(PermissionConstants::VIEW_TITLE);
	}
	
	/* Submenu of Setup menu */
	public static function canDisplayTransactionTypesMenu()
	{
		return PermissionValidator::hasPermission(PermissionConstants::VIEW_TRANSACTION_TYPE);
	}
	
	/* Main Menu */
	public static function canDisplayThirdPartiesMenu()
	{
		return MenuDisplayValidator::canDisplayAttorneysMenu() ||
			MenuDisplayValidator::canDisplayBanksMenu() ||
			MenuDisplayValidator::canDisplayContactsMenu() ||
			MenuDisplayValidator::canDisplayContractorsMenu() ||
			MenuDisplayValidator::canDisplayEstateAgentsMenu();
	}
	
	/* Submenu of Third Parties menu */
	public static function canDisplayAttorneysMenu()
	{
		return PermissionValidator::hasPermission(PermissionConstants::VIEW_ATTORNEY);
	}
	
	/* Submenu of Third Parties menu */
	public static function canDisplayBanksMenu()
	{
		return PermissionValidator::hasPermission(PermissionConstants::VIEW_BANK);
	}
	
	/* Submenu of Third Parties menu */
	public static function canDisplayContactsMenu()
	{
		return PermissionValidator::hasPermission(PermissionConstants::VIEW_CONTACT);
	}
	
	/* Submenu of Third Parties menu */
	public static function canDisplayContractorsMenu()
	{
		return PermissionValidator::hasPermission(PermissionConstants::VIEW_CONTRACTOR);
	}
	
	/* Submenu of Third Parties menu */
	public static function canDisplayEstateAgentsMenu()
	{
		return PermissionValidator::hasPermission(PermissionConstants::VIEW_ESTATE_AGENT);
	}
	
	/* Main menu */
	public static function canDisplayReportsMenu()
	{
		return MenuDisplayValidator::canDisplayLeadsToSalesMenu() ||
			MenuDisplayValidator::canDisplayAmountOfLeadsActionedMenu() ||
			MenuDisplayValidator::canDisplayLeadsPerAreaMenu() ||
			MenuDisplayValidator::canDisplayProfitAndLossByDateMenu() ||
			MenuDisplayValidator::canDisplayTotalsPerStatusMenu();
	}
	
	/* Submenu of Reports menu */
	public static function canDisplayLeadsToSalesMenu()
	{
		return PermissionValidator::hasPermission(PermissionConstants::VIEW_LEADS_TO_SALES_REPORT);
	}
	
	/* Submenu of Reports menu */
	public static function canDisplayAmountOfLeadsActionedMenu()
	{
		return PermissionValidator::hasPermission(PermissionConstants::VIEW_AMOUNT_OF_LEADS_ACTIONED_REPORT);
	}
	
	/* Submenu of Reports menu */
	public static function canDisplayLeadsPerAreaMenu()
	{
		return PermissionValidator::hasPermission(PermissionConstants::VIEW_LEADS_PER_AREA_REPORT);
	}
	
	/* Submenu of Reports menu */
	public static function canDisplayProfitAndLossByDateMenu()
	{
		return PermissionValidator::hasPermission(PermissionConstants::VIEW_PROFIT_AND_LOSS_BY_DATE_REPORT);
	}
	
	/* Submenu of Reports menu */
	public static function canDisplayTotalsPerStatusMenu()
	{
		return PermissionValidator::hasPermission(PermissionConstants::VIEW_TOTALS_PER_STATUS_REPORT);
	}
	
	/* Main menu */
	public static function canDisplayAdminMenu()
	{
		return MenuDisplayValidator::canDisplayPermissionsMenu() ||
			MenuDisplayValidator::canDisplayRolesMenu() ||
			MenuDisplayValidator::canDisplayUsersMenu() ||
			MenuDisplayValidator::canDisplayAuditTrailMenu();
	}
	
	/* Submenu of Admin menu */
	public static function canDisplayPermissionsMenu()
	{
		return PermissionValidator::hasPermission(PermissionConstants::VIEW_PERMISSION);
	}
	
	/* Submenu of Admin menu */
	public static function canDisplayRolesMenu()
	{
		return PermissionValidator::hasPermission(PermissionConstants::VIEW_ROLE);
	}
	
	/* Submenu of Admin menu */
	public static function canDisplayUsersMenu()
	{
		return PermissionValidator::hasPermission(PermissionConstants::VIEW_USER);
	}
	
	/* Submenu of Admin menu */
	public static function canDisplayAuditTrailMenu()
	{
		return PermissionValidator::hasPermission(PermissionConstants::VIEW_AUDIT_TRAIL);
	}
}