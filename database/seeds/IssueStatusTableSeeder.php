<?php

use Illuminate\Database\Seeder;
use jericho\IssueStatus;

/**
 * Seeder for populating the issue_status table
 *
 * @author Jaco Koekemoer
 * Date: 2016-10-19
 *
 */
class IssueStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$value_array = array('New', 'Viewed', 'In Progress', 'Developed', 'Tested', 'Completed', 'Rejected', 'Reopened');
    	foreach($value_array as $value)
    	{
    		$object = new IssueStatus();
    		$object->description = $value;
    		$object->created_by_id = 1;
    		$object->save();
    	}
    }
}
