<?php

use Illuminate\Database\Seeder;
use jericho\Role;
use jericho\Permission;
use jericho\Permissions\PermissionConstants;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('permission_role')->truncate();
    	
    	$superUserRole = Role::where('name', 'like', 'Super User')->first();
		$permissions = Permission::all();
		
		foreach($permissions as $permission)
		{
			$superUserRole->permissions()->attach($permission);
		}
    }
}
