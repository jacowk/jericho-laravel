<?php

use Illuminate\Database\Seeder;
use jericho\LookupIssueComponent;

/**
 * Seeder for populating the lookup_issue_components table
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-19
 *
 */
class LookupIssueComponentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$value_array = array(
    			'ACCOUNT',
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
    	foreach($value_array as $value)
    	{
    		$object = new LookupIssueComponent();
    		$object->description = $this->formatName($value);
    		$object->created_by_id = 1;
    		$object->save();
    	}
    }
    
    private function formatName($permission_name)
    {
    	$formatted_name = str_replace('_', ' ', $permission_name);
    	$formatted_name = strtolower($formatted_name);
    	$formatted_name = ucwords($formatted_name);
    	return $formatted_name;
    }
}
