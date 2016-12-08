<?php

use Illuminate\Database\Seeder;
use jericho\LookupPermissionType;

class LookupPermissionTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	LookupPermissionType::truncate();
    	 
    	$permission_type_array = array(
    			'Admin Permissions',
    			'Report Permissions',
    			'Third Party Permissions',
    			'Lookup Permissions',
    			'Property Permissions',
    			'Global Permissions' /* Applicable to all users and roles */
    			
    	);
    	foreach($permission_type_array as $permission_type)
    	{
    		$lookup_permission_type = new LookupPermissionType();
    		$lookup_permission_type->description = $permission_type;
    		$lookup_permission_type->created_by_id = 1;
    		$lookup_permission_type->save();
    	}
    }
}
