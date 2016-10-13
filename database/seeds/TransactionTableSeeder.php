<?php

use Illuminate\Database\Seeder;
use jericho\PropertyFlip;
use jericho\Transaction;

class TransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $property_flip = PropertyFlip::find(1);
        $transaction1 = new Transaction();
        $transaction1->effective_date = date_create_from_format('Y-m-d', '2016-10-01');
        $transaction1->description = "Test description 1";
        $transaction1->reference = "Test reference 1";
        $transaction1->amount = 10;
        $transaction1->account_id = 1;
        $transaction1->transaction_type_id = 1;
        $transaction1->created_by_id = 1;
        $property_flip->transactions()->save($transaction1);
        
        $transaction2 = new Transaction();
        $transaction2->effective_date = date_create_from_format('Y-m-d', '2016-10-02');
        $transaction2->description = "Test description 2";
        $transaction2->reference = "Test reference 2";
        $transaction2->amount = 10;
        $transaction2->account_id = 1;
        $transaction2->transaction_type_id = 2;
        $transaction2->created_by_id = 1;
        $property_flip->transactions()->save($transaction2);
    }
}
