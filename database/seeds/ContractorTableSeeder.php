<?php

use Illuminate\Database\Seeder;
use jericho\Contractor;

class ContractorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contractor1 = new Contractor();
        $contractor1->name = "Contractor 1";
        $contractor1->work_description = "Test Description 1";
        $contractor1->created_by_id = 1;
        $contractor1->save();
        
        $contractor2 = new Contractor();
        $contractor2->name = "Contractor 2";
        $contractor2->work_description = "Test Description 2";
        $contractor2->created_by_id = 1;
        $contractor2->save();
        
        $contractor3 = new Contractor();
        $contractor3->name = "Contractor 3";
        $contractor3->work_description = "Test Description 3";
        $contractor3->created_by_id = 1;
        $contractor3->save();
    }
}
