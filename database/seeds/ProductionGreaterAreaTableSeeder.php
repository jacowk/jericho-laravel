<?php
use Illuminate\Database\Seeder;
use jericho\GreaterArea;

/**
 * A seeder for creating initial greater areas for the production database
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-28
 *
 */
class ProductionGreaterAreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	GreaterArea::truncate();
    	 
    	$greater_areas_array = array(
    			'North',
    			'South',
    			'East',
    			'West',
    			'Other'
    	);
    	foreach($greater_areas_array as $greater_area_value)
    	{
    		$greater_area = new GreaterArea();
    		$greater_area->name = $greater_area_value;
    		$greater_area->created_by_id = 1;
    		$greater_area->save();
    	}
    }
}
