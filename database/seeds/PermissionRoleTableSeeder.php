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
    	
// 		$permissions = array(
// 				PermissionConstants::VIEW_USER,
// 				PermissionConstants::ADD_USER,
// 				PermissionConstants::UPDATE_USER,
// 				PermissionConstants::VIEW_ROLE,
// 				PermissionConstants::ADD_ROLE,
// 				PermissionConstants::UPDATE_ROLE,
// 				PermissionConstants::VIEW_PERMISSION,
// 				PermissionConstants::ADD_PERMISSION,
// 				PermissionConstants::UPDATE_PERMISSION
// 		);
		
		foreach($permissions as $permission)
		{
// 			$permission = Permission::where('name', 'like', $permission_name)->first();
			$superUserRole->permissions()->attach($permission);
		}
    }
}
