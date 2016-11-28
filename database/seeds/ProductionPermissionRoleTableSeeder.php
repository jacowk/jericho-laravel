<?php

use Illuminate\Database\Seeder;
use jericho\Role;
use jericho\Permission;

/**
 * A seeder for assigning all permissions to the super user role for production
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-28
 *
 */
class ProductionPermissionRoleTableSeeder extends Seeder
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
