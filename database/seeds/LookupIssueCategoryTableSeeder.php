<?php

use Illuminate\Database\Seeder;
use jericho\LookupIssueCategory;

/**
 * Seeder for populating the lookup_issue_category table
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-19
 *
 */
class LookupIssueCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	LookupIssueCategory::truncate();
    	
    	$value_array = array('Error', 'New Feature');
    	foreach($value_array as $value)
    	{
    		$object = new LookupIssueCategory();
    		$object->description = $value;
    		$object->created_by_id = 1;
    		$object->save();
    	}
    }
}
