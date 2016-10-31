<?php

use Illuminate\Database\Seeder;
use jericho\ContractorService;
use jericho\Contractor;

class ContractorServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	ContractorService::truncate();
    	
    	$contractor = Contractor::find(1);
        $contractor_service1 = new ContractorService();
        $contractor_service1->service_description = "Test description 1";
        $contractor_service1->contractor_type_id = 1;
        $contractor_service1->created_by_id = 1;
        $contractor->contractor_services()->save($contractor_service1);
        
        $contractor_service2 = new ContractorService();
        $contractor_service2->service_description = "Test description 2";
        $contractor_service2->contractor_type_id = 1;
        $contractor_service2->created_by_id = 1;
        $contractor->contractor_services()->save($contractor_service2);
        
        $contractor2 = Contractor::find(2);
        $contractor_service3 = new ContractorService();
        $contractor_service3->service_description = "Test description 3";
        $contractor_service3->contractor_type_id = 1;
        $contractor_service3->created_by_id = 1;
        $contractor2->contractor_services()->save($contractor_service3);
    }
}
