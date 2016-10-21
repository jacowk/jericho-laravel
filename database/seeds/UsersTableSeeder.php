<?php

use Illuminate\Database\Seeder;
use jericho\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::truncate();
    	
        $user = new User();
        $user->firstname = "Jaco";
        $user->surname = "Koekemoer";
        $user->email = "jaco.wk@gmail.com";
        $user->password = bcrypt("password");
        $user->pagination_size = 10;
        $user->created_by_id = 1;
        $user->save();
        
        $user1 = new User();
        $user1->firstname = "John";
        $user1->surname = "Doe";
        $user1->email = "john.doe@test.com";
        $user1->password = bcrypt("password");
        $user1->pagination_size = 10;
        $user1->created_by_id = 1;
        $user1->save();
        
        $user2 = new User();
        $user2->firstname = "Jim";
        $user2->surname = "Doe";
        $user2->email = "jim.doe@test.com";
        $user2->password = bcrypt("password");
        $user2->pagination_size = 10;
        $user2->created_by_id = 1;
        $user2->save();
        
//         $faker = Faker\Factory::create();
//         foreach(range(1, 20) as $index)
//         {
//         	User::create([
//         			'firstname' => $faker->firstName,
//         			'surname' => $faker->lastName,
//         			'email' => $faker->email,
//         			'password' => $faker->password,
//         			'created_by_id' => 1
//         	]);
//         }
    }
}
