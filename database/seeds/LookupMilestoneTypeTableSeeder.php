<?php

use Illuminate\Database\Seeder;
use jericho\LookupMilestoneType;

/**
 * A seeder for populating the milestone types table
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-13
 *
 */
class LookupMilestoneTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$milestone_type_array = array(
		    	'Date Offer Made',
		    	'Date Of Acceptance',
		    	'Date Of Seller Signature',
		    	'Date Of Purchaser Signature',
		    	'Renovation Start Date',
		    	'Renovation End Date',
		    	'For Sale Date',
		    	'Sell Date');
    	foreach($milestone_type_array as $milestone_type)
    	{
    		$lookup_milestone_type = new LookupMilestoneType();
    		$lookup_milestone_type->description = $milestone_type;
    		$lookup_milestone_type->created_by_id = 1;
    		$lookup_milestone_type->save();
    	}
    }
}
