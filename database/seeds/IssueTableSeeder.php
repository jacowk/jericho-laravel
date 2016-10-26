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
        
//         for ($i = 0; $i < 200; $i++)
//         {
//         	Issue::create([
//         		'assigned_to_id' => 1,
//         		'description' => 'Test Issue ' . $i,
//         		'created_by_id' => 1,
//         		'lookup_issue_component_id' => 1,
//         		'lookup_issue_category_id' => 1,
//         		'lookup_issue_severity_id' => 1,
//         		'issue_status_id' => 1
//         	]);
//         }
        
//         $faker = Faker\Factory::create();
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
