<?php

use Illuminate\Database\Seeder;
use jericho\LookupMaritalStatus;

/**
 * A seeder for creating initial marital statusses for the production database
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-28
 *
 */
class ProductionLookupMaritalStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	LookupMaritalStatus::truncate();
    	 
    	$marital_status_array = array('Married', 'Widowed', 'Seperated', 'Divorced', 'Single');
    	foreach($marital_status_array as $marital_status)
    	{
    		$lookup_marital_status = new LookupMaritalStatus();
    		$lookup_marital_status->description = $marital_status;
    		$lookup_marital_status->created_by_id = 1;
    		$lookup_marital_status->save();
    	}
    }
}
