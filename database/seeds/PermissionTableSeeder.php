<?php

use Illuminate\Database\Seeder;
use jericho\Permission;
use jericho\Util\Util;

class PermissionTableSeeder extends Seeder
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
    			'VIEW_PROFIT_AND_LOSS_REPORT',
    			'VIEW_SUMMARY_OF_TOTALS_REPORT', 
    			'VIEW_AUDIT_TRAIL',
    			'VIEW_AUDIT_FIELDS',
    			'RESET_PASSWORD',
    			'UPDATE_PROFILE',
    			'ADD_FINANCE_STATUS', 'UPDATE_FINANCE_STATUS', 'VIEW_FINANCE_STATUS',
    			'ADD_SELLER_STATUS', 'UPDATE_SELLER_STATUS', 'VIEW_SELLER_STATUS',
    			'ADD_PROPERTY_STATUS', 'UPDATE_PROPERTY_STATUS', 'VIEW_PROPERTY_STATUS',
    			'ADD_SELLING_PRICE', 'UPDATE_SELLING_PRICE', 'VIEW_SELLING_PRICE',
    			'ADD_PURCHASE_PRICE', 'UPDATE_PURCHASE_PRICE', 'VIEW_PURCHASE_PRICE',
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
