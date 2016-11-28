<?php
use Illuminate\Database\Seeder;
use jericho\User;

/**
 * A seeder for creating initial users for the production database
 * 
 * @author Jaco Koekemoer
 * Date: 2016-11-28
 *
 */
class ProductionUserTableSeeder extends Seeder
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
        $user->firstname = "Web";
        $user->surname = "Master";
        $user->email = "jaco.wk@gmail.com";
        $user->password = bcrypt("J3r1ch0");
        $user->pagination_size = 10;
        $user->created_by_id = 1;
        $user->save();
    }
}
