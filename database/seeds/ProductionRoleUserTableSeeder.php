<?php

use Illuminate\Database\Seeder;
use jericho\Role;
use jericho\User;

/**
 * A seeder for assigning the Web Master user to the Super User role for the production database
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-28
 *
 */
class ProductionRoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('role_user')->truncate();
    	
    	$user = User::where([
    				[ 'firstname', 'like', 'Web' ],
    				[ 'surname', 'like', 'Master' ]])
    			->first();
    	
    	$role = Role::where('name', 'like', 'Super User')->first();
    	$user->roles()->attach($role);
    }
}
