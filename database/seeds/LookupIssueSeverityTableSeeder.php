<?php

use Illuminate\Database\Seeder;
use jericho\LookupIssueSeverity;

/**
 * Seeder for populating the lookup_issue_severity table
 *
 * @author Jaco Koekemoer
 * Date: 2016-10-19
 *
 */
class LookupIssueSeverityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	LookupIssueSeverity::truncate();
    	
    	$value_array = array('Low', 'Medium', 'High', 'Critical');
    	foreach($value_array as $value)
    	{
    		$object = new LookupIssueSeverity();
    		$object->description = $value;
    		$object->created_by_id = 1;
    		$object->save();
    	}
    }
}
