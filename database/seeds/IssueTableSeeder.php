<?php

use Illuminate\Database\Seeder;
use jericho\Issue;

class IssueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Issue::truncate();
        
        $faker = Faker\Factory::create();
//         foreach(range(1, 20) as $index)
//         {
//         	Issue::create([
//         			'assigned_to_id' => $faker->randomNumber(1),
//         			'description' => $faker->sentence,
//         			'created_by_id' => 1
//         	]);
//         }
    }
}
