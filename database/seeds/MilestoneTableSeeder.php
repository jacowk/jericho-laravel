<?php

use Illuminate\Database\Seeder;
use jericho\Milestone;
use jericho\PropertyFlip;

class MilestoneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $property_flip = PropertyFlip::find(1);
        $milestone = new Milestone();
        $milestone->milestone_type_id = 1;
        $milestone->effective_date = date_create_from_format('Y-m-d', '2016-09-01');
        $milestone->created_by_id = 1;
        $property_flip->milestones()->save($milestone);
    }
}
