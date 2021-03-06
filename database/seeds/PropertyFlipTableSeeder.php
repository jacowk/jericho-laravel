<?php

use Illuminate\Database\Seeder;
use jericho\PropertyFlip;
use function Faker\numberBetween;

class PropertyFlipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	PropertyFlip::truncate();
    	
        $property_flip1 = new PropertyFlip();
        $property_flip1->reference_number = 1234;
        $property_flip1->title_deed_number = "ABC";
        $property_flip1->case_number = "ABC";
        $property_flip1->seller_id = 1;
        $property_flip1->purchaser_id = 2;
        $property_flip1->property_id = 1;
        $property_flip1->created_by_id = 1;
        $property_flip1->save();
        
        $property_flip2 = new PropertyFlip();
        $property_flip2->reference_number = 1235;
        $property_flip2->title_deed_number = "DEF";
        $property_flip2->case_number = "DEF";
        $property_flip2->seller_id = 1;
        $property_flip2->purchaser_id = 2;
        $property_flip2->property_id = 2;
        $property_flip2->created_by_id = 1;
        $property_flip2->save();
        
        $property_flip3 = new PropertyFlip();
        $property_flip3->reference_number = 1236;
        $property_flip3->title_deed_number = "GHI";
        $property_flip3->case_number = "GHI";
        $property_flip3->seller_id = 1;
        $property_flip3->purchaser_id = 2;
        $property_flip3->property_id = 3;
        $property_flip3->created_by_id = 1;
        $property_flip3->save();
        
        $faker = Faker\Factory::create();
        foreach(range(1, 200) as $index)
        {
        	PropertyFlip::create([
        			'reference_number' => $faker->numberBetween(2000, 9999),
        			'title_deed_number' => $faker->name,
        			'case_number' => $faker->name,
        			'seller_id' => 1,
        			'seller_status_id' => $faker->numberBetween(1, 4),
        			'property_status_id' => $faker->numberBetween(1, 2),
        			'purchaser_id' => 1,
        			'property_id' => $faker->numberBetween(1, 200),
        			'created_by_id' => 1
        	]);
        }
    }
}
