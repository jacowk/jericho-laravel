<?php

use Illuminate\Database\Seeder;
use jericho\Permission;
use jericho\Util\Util;

/**
 * A seeder for creating initial permissions for the production database
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-28
 *
 */
class ProductionPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Permission::truncate();
    	
    	$permission_array = array('ACCOUNT', 
    			'AREA', 
    			'ATTORNEY', 
    			'BANK', 
    			'CONTACT', 
    			'CONTRACTOR', 
    			'CONTRACTOR_SERVICE',
    			'DIARY_ITEM',
    			'DIARY_ITEM_COMMENT',
    			'DOCUMENT',
    			'ESTATE_AGENT',
    			'FOLLOWUP_ITEM',
    			'GREATER_AREA',
    			'ATTORNEY_TYPE',
    			'CONTRACTOR_TYPE',
    			'DOCUMENT_TYPE',
    			'ESTATE_AGENT_TYPE',
    			'MARITAL_STATUS',
    			'TITLE',
    			'TRANSACTION_TYPE',
    			'MILESTONE',
    			'MILESTONE_TYPE',
    			'NOTE',
    			'PERMISSION',
    			'PROPERTY',
    			'PROPERTY_FLIP',
    			'PROPERTY_TYPE',
    			'ROLE',
    			'SUBURB',
    			'TRANSACTION',
    			'USER',
    			'ISSUE',
    			'ISSUE_COMMENT'
    	);
    	$permission_prefix_array = array('ADD', 'UPDATE', 'VIEW');
    	foreach($permission_array as $permission_value)
    	{
    		foreach($permission_prefix_array as $permission_prefix)
    		{
    			$permission_name = $permission_prefix . '_' . $permission_value;
    			$formatted_name = $this->formatName($permission_name);
    			$permission = new Permission();
    			$permission->name = $formatted_name;
    			$permission->created_by_id = 1;
    			$permission->save();
    			$this->writeToLog($permission_name, $formatted_name);
    		}
    	}
    	
    	/* Additional Permissions */
    	$add_permissions_array = array(
    			'LINK_ATTORNEY_CONTACT', 'DELETE_ATTORNEY_CONTACT_LINK', 'VIEW_PROPERTY_FLIP_ATTORNEYS',
    			'LINK_ESTATE_AGENT_CONTACT', 'DELETE_ESTATE_AGENT_CONTACT_LINK', 'VIEW_PROPERTY_FLIP_ESTATE_AGENTS',
    			'LINK_CONTRACTOR_CONTACT', 'DELETE_CONTRACTOR_CONTACT_LINK', 'VIEW_PROPERTY_FLIP_CONTRACTORS',
    			'LINK_INVESTOR_CONTACT', 'DELETE_INVESTOR_CONTACT_LINK', 'VIEW_PROPERTY_FLIP_INVESTORS',
    			'LINK_BANK_CONTACT', 'DELETE_BANK_CONTACT_LINK', 'VIEW_PROPERTY_FLIP_BANKS',
    			'DOWNLOAD_DOCUMENT', 
//     			'SELF_ALLOCATE_DIARY_ITEM',
    			'VIEW_LEADS_TO_SALES_REPORT', 
    			'VIEW_AMOUNT_OF_LEADS_ACTIONED_REPORT',
				'VIEW_LEADS_PER_AREA_REPORT', 
    			'VIEW_PROFIT_AND_LOSS_BY_DATE_REPORT',
				'VIEW_TOTALS_PER_STATUS_REPORT', 
    			'VIEW_SUMMARY_OF_TOTALS_REPORT', 
    			'VIEW_AUDIT_TRAIL',
    			'VIEW_AUDIT_FIELDS',
    			'RESET_PASSWORD',
    			'UPDATE_PROFILE'
    	);
    	foreach($add_permissions_array as $permission_name)
    	{
    		$formatted_name = $this->formatName($permission_name);
    		$permission = new Permission();
    		$permission->name = $formatted_name;
    		$permission->created_by_id = 1;
    		$permission->save();
    		$this->writeToLog($permission_name, $formatted_name);
    	}
    }
    
    private function formatName($permission_name)
    {
    	$formatted_name = str_replace('_', ' ', $permission_name);
    	$formatted_name = strtolower($formatted_name);
    	$formatted_name = ucwords($formatted_name);
    	return $formatted_name;
    }
    
    private function writeToLog($permission_name, $formatted_name)
    {
    	Util::writeToLog('const ' . $permission_name . ' = ' . '\'' . $formatted_name . '\';');
    }
}
