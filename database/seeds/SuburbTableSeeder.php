<?php

use Illuminate\Database\Seeder;
use jericho\Suburb;
use jericho\Area;

class SuburbTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suburb = new Suburb();
        $suburb->name = "Wilropark";
        $suburb->box_code = 1731;
        $suburb->street_code = 1724;
        $suburb->created_by_id = 1;
        $suburb->save();
        
        $area = Area::find(1);
        $area->suburbs()->save($suburb);
        
        $suburb2 = new Suburb();
        $suburb2->name = "Horizon View";
        $suburb2->street_code = 1724;
        $suburb2->created_by_id = 1;
        $suburb2->save();
        
        $area = Area::find(1);
        $area->suburbs()->save($suburb2);
        
        $suburb3 = new Suburb();
        $suburb3->name = "Helderkruin";
        $suburb3->box_code = 1733;
        $suburb3->street_code = 1724;
        $suburb3->created_by_id = 1;
        $suburb3->save();
        
        $area = Area::find(1);
        $area->suburbs()->save($suburb3);
    }
}
