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
        
//         $faker = Faker\Factory::create();
//         foreach(range(1, 20) as $index)
//         {
//         	Role::create([
//         			'name' => $faker->word,
//         			'created_by_id' => 1
//         	]);
//         }
    }
}
