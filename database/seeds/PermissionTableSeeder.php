<?php

use Illuminate\Database\Seeder;
use jericho\Permission;
use jericho\Util\Util;
use jericho\LookupPermissionType;

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
    	
    	$this->addAdminPermissions();
    	$this->addReportPermissions();
    	$this->addThirdPartyPermissions();
    	$this->addLookupPermissions();
    	$this->addPropertyPermissions();
    	$this->addGlobalPermissions();
    	return;
    	
    	/* Old code */
//     	$permission_array = array('ACCOUNT', 
//     			'AREA', 
//     			'ATTORNEY', 
//     			'BANK', 
//     			'CONTACT', 
//     			'CONTRACTOR', 
//     			'CONTRACTOR_SERVICE',
//     			'DIARY_ITEM',
//     			'DIARY_ITEM_COMMENT',
//     			'DOCUMENT',
//     			'ESTATE_AGENT',
//     			'FOLLOWUP_ITEM',
//     			'GREATER_AREA',
//     			'ATTORNEY_TYPE',
//     			'CONTRACTOR_TYPE',
//     			'DOCUMENT_TYPE',
//     			'ESTATE_AGENT_TYPE',
//     			'MARITAL_STATUS',
//     			'TITLE',
//     			'TRANSACTION_TYPE',
//     			'MILESTONE',
//     			'MILESTONE_TYPE',
//     			'NOTE',
//     			'PERMISSION',
//     			'PROPERTY',
//     			'PROPERTY_FLIP',
//     			'PROPERTY_TYPE',
//     			'ROLE',
//     			'SUBURB',
//     			'TRANSACTION',
//     			'USER',
//     			'ISSUE',
//     			'ISSUE_COMMENT'
//     	);
//     	$permission_prefix_array = array('ADD', 'UPDATE', 'VIEW');
//     	foreach($permission_array as $permission_value)
//     	{
//     		foreach($permission_prefix_array as $permission_prefix)
//     		{
//     			$permission_name = $permission_prefix . '_' . $permission_value;
//     			$formatted_name = $this->formatName($permission_name);
//     			$permission = new Permission();
//     			$permission->name = $formatted_name;
//     			$permission->created_by_id = 1;
//     			$permission->save();
//     			$this->writeToLog($permission_name, $formatted_name);
//     		}
//     	}
    	
//     	/* Additional Permissions */
//     	$add_permissions_array = array(
//     			'LINK_ATTORNEY_CONTACT', 'DELETE_ATTORNEY_CONTACT_LINK', 'VIEW_PROPERTY_FLIP_ATTORNEYS',
//     			'LINK_ESTATE_AGENT_CONTACT', 'DELETE_ESTATE_AGENT_CONTACT_LINK', 'VIEW_PROPERTY_FLIP_ESTATE_AGENTS',
//     			'LINK_CONTRACTOR_CONTACT', 'DELETE_CONTRACTOR_CONTACT_LINK', 'VIEW_PROPERTY_FLIP_CONTRACTORS',
//     			'LINK_INVESTOR_CONTACT', 'DELETE_INVESTOR_CONTACT_LINK', 'VIEW_PROPERTY_FLIP_INVESTORS',
//     			'LINK_BANK_CONTACT', 'DELETE_BANK_CONTACT_LINK', 'VIEW_PROPERTY_FLIP_BANKS',
//     			'DOWNLOAD_DOCUMENT', 
// //     			'SELF_ALLOCATE_DIARY_ITEM',
//     			'VIEW_PROFIT_AND_LOSS_REPORT',
//     			'VIEW_SUMMARY_OF_TOTALS_REPORT', 
//     			'VIEW_AUDIT_TRAIL',
//     			'VIEW_AUDIT_FIELDS',
//     			'RESET_PASSWORD',
//     			'UPDATE_PROFILE',
//     			'ADD_FINANCE_STATUS', 'UPDATE_FINANCE_STATUS', 'VIEW_FINANCE_STATUS',
//     			'ADD_SELLER_STATUS', 'UPDATE_SELLER_STATUS', 'VIEW_SELLER_STATUS',
//     			'ADD_PROPERTY_STATUS', 'UPDATE_PROPERTY_STATUS', 'VIEW_PROPERTY_STATUS',
//     			'ADD_SELLING_PRICE', 'UPDATE_SELLING_PRICE', 'VIEW_SELLING_PRICE',
//     			'ADD_PURCHASE_PRICE', 'UPDATE_PURCHASE_PRICE', 'VIEW_PURCHASE_PRICE',
//     			'VIEW_PROPERTY_FLIP_REPORT'
//     	);
//     	foreach($add_permissions_array as $permission_name)
//     	{
//     		$formatted_name = $this->formatName($permission_name);
//     		$permission = new Permission();
//     		$permission->name = $formatted_name;
//     		$permission->created_by_id = 1;
//     		$permission->save();
//     		$this->writeToLog($permission_name, $formatted_name);
//     	}
    }
    
    /**
     * Add Admin permissions
     */
    private function addAdminPermissions()
    {
    	$permission_type = LookupPermissionType::where('description', 'like', 'Admin Permissions')->first();
    	
    	$permission_array = array(
    			'PERMISSION',
    			'ROLE',
    			'USER'
    	);
    	$permission_prefix_array = array('ADD', 'UPDATE', 'VIEW');
    	$this->saveMultiPermissions($permission_type, $permission_array, $permission_prefix_array);
    	
    	
    	$permission_array_2 = array(
    		'VIEW_AUDIT_TRAIL', 
    		'VIEW_AUDIT_FIELDS',
    		'RESET_PASSWORD',
		);
		$this->savePermissions($permission_type, $permission_array_2);
    }
    
    /**
     * Add report permissions
     */
    private function addReportPermissions()
    {
    	$permission_type = LookupPermissionType::where('description', 'like', 'Report Permissions')->first();
    	 
    	$permission_array = array(
    			'VIEW_PROFIT_AND_LOSS_REPORT',
    			'VIEW_SUMMARY_OF_TOTALS_REPORT'
    	);
    	$this->savePermissions($permission_type, $permission_array);
    }

    /**
     * Add third party permissions
     */
    private function addThirdPartyPermissions()
    {
    	$permission_type = LookupPermissionType::where('description', 'like', 'Third Party Permissions')->first();
    	 
    	$permission_array = array(
    			'ATTORNEY', 
    			'BANK', 
    			'CONTACT', 
    			'CONTRACTOR',
    			'CONTRACTOR_SERVICE',
    			'ESTATE AGENT'
    	);
    	$permission_prefix_array = array('ADD', 'UPDATE', 'VIEW');
    	$this->saveMultiPermissions($permission_type, $permission_array, $permission_prefix_array);
    }

    /**
     * Add lookup permissions
     */
    private function addLookupPermissions()
    {
    	$permission_type = LookupPermissionType::where('description', 'like', 'Lookup Permissions')->first();
    	
    	$permission_array = array(
    			'ACCOUNT',
    			'GREATER AREA',
    			'AREA',
    			'SUBURB',
    			'ATTORNEY TYPE',
    			'CONTRACTOR TYPE',
    			'DOCUMENT TYPE',
    			'ESTATE AGENT TYPE',
    			'MARITAL STATUS',
    			'PROPERTY TYPE',
    			'MILESTONE TYPE',
    			'TITLE',
    			'TRANSACTION TYPE'
    	);
    	$permission_prefix_array = array('ADD', 'UPDATE', 'VIEW');
    	$this->saveMultiPermissions($permission_type, $permission_array, $permission_prefix_array);
    }
    
    /**
     * Add property permissions
     */
    private function addPropertyPermissions()
    {
    	$permission_type = LookupPermissionType::where('description', 'like', 'Property Permissions')->first();
    	 
    	$permission_array = array(
    			'PROPERTY',
    			'PROPERTY_FLIP',
    			'DIARY_ITEM',
    	    	'DIARY_ITEM_COMMENT',
    	    	'DOCUMENT',
    			'FOLLOWUP_ITEM',
    			'MILESTONE',
    			'NOTE',
    			'TRANSACTION',
    			'FINANCE_STATUS',
    			'SELLER_STATUS',
    			'PROPERTY_STATUS',
    			'SELLING_PRICE',
    			'PURCHASE_PRICE'
    	);
    	$permission_prefix_array = array('ADD', 'UPDATE', 'VIEW');
    	$this->saveMultiPermissions($permission_type, $permission_array, $permission_prefix_array);
    	
    	/*  */
    	$permission_array_2 = array(
    			'LINK_ATTORNEY_CONTACT', 
    			'DELETE_ATTORNEY_CONTACT_LINK', 
    			'VIEW_PROPERTY_FLIP_ATTORNEYS',
    			'LINK_ESTATE_AGENT_CONTACT', 
    			'DELETE_ESTATE_AGENT_CONTACT_LINK', 
    			'VIEW_PROPERTY_FLIP_ESTATE_AGENTS',
    			'LINK_CONTRACTOR_CONTACT', 
    			'DELETE_CONTRACTOR_CONTACT_LINK', 
    			'VIEW_PROPERTY_FLIP_CONTRACTORS',
    			'LINK_INVESTOR_CONTACT', 
    			'DELETE_INVESTOR_CONTACT_LINK', 
    			'VIEW_PROPERTY_FLIP_INVESTORS',
    			'LINK_BANK_CONTACT', 
    			'DELETE_BANK_CONTACT_LINK', 
    			'VIEW_PROPERTY_FLIP_BANKS',
    			'DOWNLOAD_DOCUMENT', 
    			'VIEW_PROPERTY_FLIP_REPORT'
    	);
    	$this->savePermissions($permission_type, $permission_array_2);
    }

    /**
     * Add global permissions
     */
    private function addGlobalPermissions()
    {
    	$permission_type = LookupPermissionType::where('description', 'like', 'Global Permissions')->first();
    	 
    	$permission_array = array(
    			'ISSUE',
    	    	'ISSUE_COMMENT',
    	);
    	$permission_prefix_array = array('ADD', 'UPDATE', 'VIEW');
    	$this->saveMultiPermissions($permission_type, $permission_array, $permission_prefix_array);
    	
    	$permission_array_2 = array(
    			'UPDATE_PROFILE'
    	);
    	$this->savePermissions($permission_type, $permission_array_2);
    }
    
    /**
     * Save multi level permissions (Includes ADD, UPDATE, VIEW)
     * @param unknown $permission_type
     * @param unknown $permission_array
     * @param unknown $permission_prefix_array
     */
    private function saveMultiPermissions($permission_type, $permission_array, $permission_prefix_array)
    {
    	foreach($permission_array as $permission_value)
    	{
    		foreach($permission_prefix_array as $permission_prefix)
    		{
    			$permission_name = $permission_prefix . '_' . $permission_value;
    			$formatted_name = $this->formatName($permission_name);
    			$this->savePermission($permission_name, $formatted_name, $permission_type);
    			
    		}
    	}
    }
    
    /**
     * Save permissions (Excludes ADD, UPDATE, VIEW)
     * 
     * @param unknown $permission_type
     * @param unknown $permission_array
     */
    private function savePermissions($permission_type, $permission_array)
    {
    	foreach($permission_array as $permission_name)
    	{
    		$formatted_name = $this->formatName($permission_name);
			$permission = new Permission();
			$permission->name = $formatted_name;
			$permission->permission_type_id = $permission_type->id;
			$permission->created_by_id = 1;
			$permission->save();
			$this->writeToLog($permission_name, $formatted_name);
    	}
    }
    
    /**
     * The final method to do the actual save
     * 
     * @param unknown $permission_name
     * @param unknown $formatted_name
     * @param unknown $permission_type
     */
    private function savePermission($permission_name, $formatted_name, $permission_type)
    {
    	$formatted_name = $this->formatName($permission_name);
    	$permission = new Permission();
    	$permission->name = $formatted_name;
    	$permission->permission_type_id = $permission_type->id;
    	$permission->created_by_id = 1;
    	$permission->save();
    	$this->writeToLog($permission_name, $formatted_name);
    }
    
    /**
     * Format the name to be stored in the database
     *  
     * @param unknown $permission_name
     * @return string
     */
    private function formatName($permission_name)
    {
    	$formatted_name = str_replace('_', ' ', $permission_name);
    	$formatted_name = strtolower($formatted_name);
    	$formatted_name = ucwords($formatted_name);
    	return $formatted_name;
    }
    
    /**
     * Write permissions to log, to be copied to the PermissionConstants class
     * 
     * @param unknown $permission_name
     * @param unknown $formatted_name
     */
    private function writeToLog($permission_name, $formatted_name)
    {
    	Util::writeToLog('const ' . $permission_name . ' = ' . '\'' . $formatted_name . '\';');
    }
}
