<?php

use Illuminate\Database\Seeder;
use jericho\Bank;

class BankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Bank::truncate();
    	
        $bank1 = new Bank();
        $bank1->name = "Bank 1";
        $bank1->created_by_id = 1;
        $bank1->save();
        
        $bank2 = new Bank();
        $bank2->name = "Bank 2";
        $bank2->created_by_id = 1;
        $bank2->save();
        
        $bank3 = new Bank();
        $bank3->name = "Bank 3";
        $bank3->created_by_id = 1;
        $bank3->save();
        
        $faker = Faker\Factory::create();
        foreach(range(1, 20) as $index)
        {
        	Bank::create([
        			'name' => $faker->word,
        			'created_by_id' => 1
        	]);
        }
    }
}
