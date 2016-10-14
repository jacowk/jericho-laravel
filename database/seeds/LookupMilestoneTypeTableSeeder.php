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
		    	'Sell Date',
    			/* Additional Milestones */
    			'Received Offer To Purchase And Opened File',
    			'Rates Clearance Completed',
    			'Levy Clearance Completed',
    			'Received Confirmation Of Bond Approval',
    			'Bond Attorneys Appointed',
    			'Bond Documents Signed By Purchaser',
    			'Received Guarantees',
    			'Deposit Paid By Purchaser',
    			'Transfer Costs Paid By Purchaser',
    			'Received Proceed From Bank To Lodge',
    			'Purchaser Signed Transfer Documents',
    			'Transfer Duty Completed',
    			'Electrical Compliance Certificate Completed',
    			'Lodged In Deeds Office',
    			'On Preparation',
    			'Registered'
    	);
    	foreach($milestone_type_array as $milestone_type)
    	{
    		$lookup_milestone_type = new LookupMilestoneType();
    		$lookup_milestone_type->description = $milestone_type;
    		$lookup_milestone_type->created_by_id = 1;
    		$lookup_milestone_type->save();
    	}
    }
}
