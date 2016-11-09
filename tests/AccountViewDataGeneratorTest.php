<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Accounts\AccountViewDataGenerator;
use jericho\PropertyFlip;
use jericho\Transaction;
use jericho\Account;
use jericho\Util\Util;

/**
 * The test case for AccountViewDataGenerator.
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-21
 * 
 */
class AccountViewDataGeneratorTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGenerateData()
    {
    	$property_flip_id = 1;
    	$accountViewDataGenerator = new AccountViewDataGenerator();
    	$account_transactions = $accountViewDataGenerator->generateData($property_flip_id);
		$this->assertNotNull($account_transactions);
		/* Find the PropertyFlip */
		$property_flip = PropertyFlip::find($property_flip_id);
		$accounts = Transaction::where('property_flip_id', '=', $property_flip_id)
							->select('account_id')
							->distinct()
							->get();
		/* Key is the account id, and the $value is an array of transactions */
		foreach ($accounts as $account)
		{
			$this->assertNotNull($account_transactions[$account['account_id']]);
			$transaction_account = $account_transactions[$account['account_id']];
			$account_model = $transaction_account[0];
			$transactions = $transaction_account[1];
			$balance = $transaction_account[2];
			$this->assertNotNull($account_model);
			$this->assertNotNull($transactions);
			$this->assertNotNull($balance);
			
			/* Validate accounts */
			$account_to_validate = Account::find($account['account_id']);
			$this->assertEquals($account_to_validate['name'], $account_model['name']);
			
			/* Validate transactions */
			$this->assertTrue(count($transactions) > 0);
			
			/* Validate account balance */
			$this->assertTrue($balance > 0);
		}
    }
}
/*
(
    [1] => Array
        (
            [0] => jericho\Account Object
                (
                    [fillable:protected] => Array
                        (
                            [0] => name
                            [1] => created_by_id
                            [2] => updated_by_id
                        )

                    [connection:protected] =>
                    [table:protected] =>
                    [primaryKey:protected] => id
                    [keyType:protected] => int
                    [perPage:protected] => 15
                    [incrementing] => 1
                    [timestamps] => 1
                    [attributes:protected] => Array
                        (
                            [id] => 1
                            [name] => Profit and Loss Account
                            [account_type_id] =>
                            [created_by_id] => 1
                            [updated_by_id] =>
                            [deleted_by_id] =>
                            [created_at] => 2016-11-02 08:39:22
                            [updated_at] => 2016-11-02 08:39:22
                            [deleted_at] =>
                        )

                    [original:protected] => Array
                        (
                            [id] => 1
                            [name] => Profit and Loss Account
                            [account_type_id] =>
                            [created_by_id] => 1
                            [updated_by_id] =>
                            [deleted_by_id] =>
                            [created_at] => 2016-11-02 08:39:22
                            [updated_at] => 2016-11-02 08:39:22
                            [deleted_at] =>
                        )

                    [relations:protected] => Array
                        (
                        )

                    [hidden:protected] => Array
                        (
                        )

                    [visible:protected] => Array
                        (
                        )

                    [appends:protected] => Array
                        (
                        )

                    [guarded:protected] => Array
                        (
                            [0] => *
                        )

                    [dates:protected] => Array
                        (
                        )

                    [dateFormat:protected] =>
                    [casts:protected] => Array
                        (
                        )

                    [touches:protected] => Array
                        (
                        )

                    [observables:protected] => Array
                        (
                        )

                    [with:protected] => Array
                        (
                        )

                    [exists] => 1
                    [wasRecentlyCreated] =>
                    [doKeep:jericho\Account:private] => Array
                        (
                        )

                    [dontKeep:jericho\Account:private] => Array
                        (
                        )

                    [originalData:jericho\Account:private] => Array
                        (
                        )

                    [updatedData:jericho\Account:private] => Array
                        (
                        )

                    [updating:jericho\Account:private] =>
                    [dirtyData:protected] => Array
                        (
                        )

                    [oldData:protected] => Array
                        (
                        )

                    [newData:protected] => Array
                        (
                        )

                    [typeAuditing:protected] =>
                )

            [1] => Illuminate\Database\Eloquent\Collection Object
                (
                    [items:protected] => Array
                        (
                            [0] => jericho\Transaction Object
                                (
                                    [connection:protected] =>
                                    [table:protected] =>
                                    [primaryKey:protected] => id
                                    [keyType:protected] => int
                                    [perPage:protected] => 15
                                    [incrementing] => 1
                                    [timestamps] => 1
                                    [attributes:protected] => Array
                                        (
                                            [id] => 1
                                            [effective_date] => 2016-10-01
                                            [description] => Test description 1
                                            [reference] => Test reference 1
                                            [debit_amount] => 10000000
                                            [credit_amount] =>
                                            [account_id] => 1
                                            [transaction_type_id] => 1
                                            [property_flip_id] => 1
                                            [created_by_id] => 1
                                            [updated_by_id] =>
                                            [deleted_by_id] =>
                                            [created_at] => 2016-11-02 08:39:24
                                            [updated_at] => 2016-11-02 08:39:24
                                            [deleted_at] =>
                                        )

                                    [original:protected] => Array
                                        (
                                            [id] => 1
                                            [effective_date] => 2016-10-01
                                            [description] => Test description 1
                                            [reference] => Test reference 1
                                            [debit_amount] => 10000000
                                            [credit_amount] =>
                                            [account_id] => 1
                                            [transaction_type_id] => 1
                                            [property_flip_id] => 1
                                            [created_by_id] => 1
                                            [updated_by_id] =>
                                            [deleted_by_id] =>
                                            [created_at] => 2016-11-02 08:39:24
                                            [updated_at] => 2016-11-02 08:39:24
                                            [deleted_at] =>
                                        )

                                    [relations:protected] => Array
                                        (
                                        )

                                    [hidden:protected] => Array
                                        (
                                        )

                                    [visible:protected] => Array
                                        (
                                        )

                                    [appends:protected] => Array
                                        (
                                        )

                                    [fillable:protected] => Array
                                        (
                                        )

                                    [guarded:protected] => Array
                                        (
                                            [0] => *
                                        )

                                    [dates:protected] => Array
                                        (
                                        )

                                    [dateFormat:protected] =>
                                    [casts:protected] => Array
                                        (
                                        )

                                    [touches:protected] => Array
                                        (
                                        )

                                    [observables:protected] => Array
                                        (
                                        )

                                    [with:protected] => Array
                                        (
                                        )

                                    [exists] => 1
                                    [wasRecentlyCreated] =>
                                    [doKeep:jericho\Transaction:private] => Array
                                        (
                                        )

                                    [dontKeep:jericho\Transaction:private] => Array
                                        (
                                        )

                                    [originalData:jericho\Transaction:private] => Array
                                        (
                                        )

                                    [updatedData:jericho\Transaction:private] => Array
                                        (
                                        )

                                    [updating:jericho\Transaction:private] =>
                                    [dirtyData:protected] => Array
                                        (
                                        )

                                    [oldData:protected] => Array
                                        (
                                        )

                                    [newData:protected] => Array
                                        (
                                        )

                                    [typeAuditing:protected] =>
                                )

                            [1] => jericho\Transaction Object
                                (
                                    [connection:protected] =>
                                    [table:protected] =>
                                    [primaryKey:protected] => id
                                    [keyType:protected] => int
                                    [perPage:protected] => 15
                                    [incrementing] => 1
                                    [timestamps] => 1
                                    [attributes:protected] => Array
                                        (
                                            [id] => 2
                                            [effective_date] => 2016-10-02
                                            [description] => Test description 2
                                            [reference] => Test reference 2
                                            [debit_amount] =>
                                            [credit_amount] => 25000000
                                            [account_id] => 1
                                            [transaction_type_id] => 2
                                            [property_flip_id] => 1
                                            [created_by_id] => 1
                                            [updated_by_id] =>
                                            [deleted_by_id] =>
                                            [created_at] => 2016-11-02 08:39:24
                                            [updated_at] => 2016-11-02 08:39:24
                                            [deleted_at] =>
                                        )

                                    [original:protected] => Array
                                        (
                                            [id] => 2
                                            [effective_date] => 2016-10-02
                                            [description] => Test description 2
                                            [reference] => Test reference 2
                                            [debit_amount] =>
                                            [credit_amount] => 25000000
                                            [account_id] => 1
                                            [transaction_type_id] => 2
                                            [property_flip_id] => 1
                                            [created_by_id] => 1
                                            [updated_by_id] =>
                                            [deleted_by_id] =>
                                            [created_at] => 2016-11-02 08:39:24
                                            [updated_at] => 2016-11-02 08:39:24
                                            [deleted_at] =>
                                        )

                                    [relations:protected] => Array
                                        (
                                        )

                                    [hidden:protected] => Array
                                        (
                                        )

                                    [visible:protected] => Array
                                        (
                                        )

                                    [appends:protected] => Array
                                        (
                                        )

                                    [fillable:protected] => Array
                                        (
                                        )

                                    [guarded:protected] => Array
                                        (
                                            [0] => *
                                        )

                                    [dates:protected] => Array
                                        (
                                        )

                                    [dateFormat:protected] =>
                                    [casts:protected] => Array
                                        (
                                        )

                                    [touches:protected] => Array
                                        (
                                        )

                                    [observables:protected] => Array
                                        (
                                        )

                                    [with:protected] => Array
                                        (
                                        )

                                    [exists] => 1
                                    [wasRecentlyCreated] =>
                                    [doKeep:jericho\Transaction:private] => Array
                                        (
                                        )

                                    [dontKeep:jericho\Transaction:private] => Array
                                        (
                                        )

                                    [originalData:jericho\Transaction:private] => Array
                                        (
                                        )

                                    [updatedData:jericho\Transaction:private] => Array
                                        (
                                        )

                                    [updating:jericho\Transaction:private] =>
                                    [dirtyData:protected] => Array
                                        (
                                        )

                                    [oldData:protected] => Array
                                        (
                                        )

                                    [newData:protected] => Array
                                        (
                                        )

                                    [typeAuditing:protected] =>
                                )

                            [2] => jericho\Transaction Object
                                (
                                    [connection:protected] =>
                                    [table:protected] =>
                                    [primaryKey:protected] => id
                                    [keyType:protected] => int
                                    [perPage:protected] => 15
                                    [incrementing] => 1
                                    [timestamps] => 1
                                    [attributes:protected] => Array
                                        (
                                            [id] => 3
                                            [effective_date] => 2016-11-04
                                            [description] => Test
                                            [reference] => Test
                                            [debit_amount] => 10000000
                                            [credit_amount] => 0
                                            [account_id] => 1
                                            [transaction_type_id] => 2
                                            [property_flip_id] => 1
                                            [created_by_id] => 1
                                            [updated_by_id] =>
                                            [deleted_by_id] =>
                                            [created_at] => 2016-11-04 14:20:25
                                            [updated_at] => 2016-11-04 14:20:25
                                            [deleted_at] =>
                                        )

                                    [original:protected] => Array
                                        (
                                            [id] => 3
                                            [effective_date] => 2016-11-04
                                            [description] => Test
                                            [reference] => Test
                                            [debit_amount] => 10000000
                                            [credit_amount] => 0
                                            [account_id] => 1
                                            [transaction_type_id] => 2
                                            [property_flip_id] => 1
                                            [created_by_id] => 1
                                            [updated_by_id] =>
                                            [deleted_by_id] =>
                                            [created_at] => 2016-11-04 14:20:25
                                            [updated_at] => 2016-11-04 14:20:25
                                            [deleted_at] =>
                                        )

                                    [relations:protected] => Array
                                        (
                                        )

                                    [hidden:protected] => Array
                                        (
                                        )

                                    [visible:protected] => Array
                                        (
                                        )

                                    [appends:protected] => Array
                                        (
                                        )

                                    [fillable:protected] => Array
                                        (
                                        )

                                    [guarded:protected] => Array
                                        (
                                            [0] => *
                                        )

                                    [dates:protected] => Array
                                        (
                                        )

                                    [dateFormat:protected] =>
                                    [casts:protected] => Array
                                        (
                                        )

                                    [touches:protected] => Array
                                        (
                                        )

                                    [observables:protected] => Array
                                        (
                                        )

                                    [with:protected] => Array
                                        (
                                        )

                                    [exists] => 1
                                    [wasRecentlyCreated] =>
                                    [doKeep:jericho\Transaction:private] => Array
                                        (
                                        )

                                    [dontKeep:jericho\Transaction:private] => Array
                                        (
                                        )

                                    [originalData:jericho\Transaction:private] => Array
                                        (
                                        )

                                    [updatedData:jericho\Transaction:private] => Array
                                        (
                                        )

                                    [updating:jericho\Transaction:private] =>
                                    [dirtyData:protected] => Array
                                        (
                                        )

                                    [oldData:protected] => Array
                                        (
                                        )

                                    [newData:protected] => Array
                                        (
                                        )

                                    [typeAuditing:protected] =>
                                )

                        )

                )

            [2] => 5000000
        )

)

*/