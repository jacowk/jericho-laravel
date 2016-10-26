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
    	
        for ($i = 0; $i < 100; $i++)
        {
        	$bank = new Bank();
        	$bank->name = "Test Bank " . $i;
        	$bank->created_by_id = 1;
        	$bank->save();
        }
        
//         $faker = Faker\Factory::create();
//         foreach(range(1, 100) as $index)
//         {
//         	Bank::create([
//         			'name' => $faker->word,
//         			'created_by_id' => 1
//         	]);
//         }
    }
}
