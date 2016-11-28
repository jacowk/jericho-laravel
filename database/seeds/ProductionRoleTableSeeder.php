<?php

use Illuminate\Database\Seeder;
use jericho\Role;

/**
 * A seeder for creating initial roles for the production database
 * 
 * @author Jaco Koekemoer
 * Date: 2016-11-28
 *
 */
class ProductionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Role::truncate();
    	
        $roles_array = array(
        		'Super User', 
        		'Administrator', 
        		'Manager', 
        		'Supervisor', 
        		'Call Centre Agent',
        		'Data Capturer'
        );
        foreach($roles_array as $role_value)
        {
        	$role = new Role();
        	$role->name = $role_value;
        	$role->created_by_id = 1;
        	$role->save();
        }
    }
}
