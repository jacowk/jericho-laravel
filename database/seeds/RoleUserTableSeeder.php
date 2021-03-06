<?php

use Illuminate\Database\Seeder;
use jericho\User;
use jericho\Role;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('role_user')->truncate();
    	
    	$user = User::find(1);
    	
    	$role = Role::find(1);
    	
    	$user->roles()->attach($role);
    }
}
