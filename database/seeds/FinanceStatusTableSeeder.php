<?php

use Illuminate\Database\Seeder;
use jericho\FinanceStatus;

class FinanceStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $finance_status1 = new FinanceStatus();
        $finance_status1->description = 'Awaiting Acceptance';
        $finance_status1->created_by_id = 1;
        $finance_status1->save();
        
        $finance_status2 = new FinanceStatus();
        $finance_status2->description = 'Accepted';
        $finance_status2->created_by_id = 1;
        $finance_status2->save();
        
        $finance_status3 = new FinanceStatus();
        $finance_status3->description = 'Declined';
        $finance_status3->created_by_id = 1;
        $finance_status3->save();
    }
}
