<?php

use Illuminate\Database\Seeder;
use jericho\LookupTransactionType;

class LookupTransactionTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lookup_transaction_type1 = new LookupTransactionType();
        $lookup_transaction_type1->description = "Renovations";
        $lookup_transaction_type1->created_by_id = 1;
        $lookup_transaction_type1->save();
        
        $lookup_transaction_type2 = new LookupTransactionType();
        $lookup_transaction_type2->description = "Purchase Price";
        $lookup_transaction_type2->created_by_id = 1;
        $lookup_transaction_type2->save();
        
        $lookup_transaction_type3 = new LookupTransactionType();
        $lookup_transaction_type3->description = "Legal Fees";
        $lookup_transaction_type3->created_by_id = 1;
        $lookup_transaction_type3->save();
        
        $lookup_transaction_type4 = new LookupTransactionType();
        $lookup_transaction_type4->description = "Sourcing Fees";
        $lookup_transaction_type4->created_by_id = 1;
        $lookup_transaction_type4->save();
    }
}
