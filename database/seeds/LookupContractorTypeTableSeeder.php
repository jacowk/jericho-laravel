<?php

use Illuminate\Database\Seeder;
use jericho\LookupContractorType;

/**
 * A seeder for populating the system with Contractor types
 * 
 * @author Jaco Koekemoer
 *
 */
class LookupContractorTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	LookupContractorType::truncate();
    	
    	$contractor_type_array = array('Electrician', 'Tiler', 'Builder', 'Painter');
    	foreach($contractor_type_array as $contractor_type)
    	{
    		$lookup_contractor_type = new LookupContractorType();
    		$lookup_contractor_type->description = $contractor_type;
    		$lookup_contractor_type->created_by_id = 1;
    		$lookup_contractor_type->save();
    	}
    	
//     	$faker = Faker\Factory::create();
//     	foreach(range(1, 20) as $index)
//     	{
//     		LookupContractorType::create([
//     				'description' => $faker->word,
//     				'created_by_id' => 1
//     		]);
//     	}
    }
}
