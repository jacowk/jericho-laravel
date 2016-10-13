<?php

use Illuminate\Database\Seeder;
use jericho\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
