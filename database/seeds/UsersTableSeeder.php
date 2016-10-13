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
        $user = new User();
        $user->firstname = "Jaco";
        $user->surname = "Koekemoer";
        $user->email = "jaco.wk@gmail.com";
        $user->password = bcrypt("password");
        $user->created_by_id = 1;
        $user->save();
        
        $user1 = new User();
        $user1->firstname = "John";
        $user1->surname = "Doe";
        $user1->email = "john.doe@test.com";
        $user1->password = bcrypt("password");
        $user1->created_by_id = 1;
        $user1->save();
        
        $user2 = new User();
        $user2->firstname = "Jim";
        $user2->surname = "Doe";
        $user2->email = "jim.doe@test.com";
        $user2->password = bcrypt("password");
        $user2->created_by_id = 1;
        $user2->save();
    }
}
