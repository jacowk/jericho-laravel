<?php

use Illuminate\Database\Seeder;
use jericho\Account;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Account::truncate();
    	
        $account1 = new Account();
        $account1->name = "Profit and Loss Account";
        $account1->created_by_id = 1;
        $account1->save();
        
        $faker = Faker\Factory::create();
        foreach(range(1, 20) as $index)
        {
        	Account::create([
        			'name' => $faker->word,
        			'created_by_id' => 1
        	]);
        }
    }
}
