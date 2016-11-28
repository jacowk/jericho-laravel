<?php

use Illuminate\Database\Seeder;
use jericho\Account;

/**
 * A seeder for creating initial accounts for the production database
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-28
 *
 */
class ProductionAccountTableSeeder extends Seeder
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
    }
}
