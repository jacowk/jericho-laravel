<?php

use Illuminate\Database\Seeder;
use jericho\IssueStatus;

/**
 * A seeder for creating initial issue status for the production database
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-28
 *
 */
class ProductionIssueStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	IssueStatus::truncate();
    	 
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
