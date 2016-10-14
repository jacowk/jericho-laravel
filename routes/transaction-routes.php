<?php
/* ****************************** Transaction Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_TRANSACTION], function() {
		/* View Transaction */
		Route::get('/view-transaction/{transaction_id}', [
				'uses' => 'TransactionController@getViewTransaction',
				'as' => 'view-transaction'
		]);
		
		Route::post('/view-transaction/{transaction_id}', [
				'uses' => 'TransactionController@getViewTransaction',
				'as' => 'view-transaction'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_TRANSACTION], function() {
		/* Add an Transaction */
		Route::post('/add-transaction/{property_flip_id}', [
				'uses' => 'TransactionController@getAddTransaction',
				'as' => 'add-transaction'
		]);
		
		Route::get('/add-transaction/{property_flip_id}', [
				'uses' => 'TransactionController@getAddTransaction',
				'as' => 'add-transaction'
		]);
		
		Route::post('/do-add-transaction', [
				'uses' => 'TransactionController@postDoAddTransaction',
				'as' => 'do-add-transaction'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_TRANSACTION], function() {
		/* Update an Transaction */
		Route::get('/update-transaction/{transaction_id}', [
				'uses' => 'TransactionController@getUpdateTransaction',
				'as' => 'update-transaction'
		]);
		
		Route::post('/update-transaction/{transaction_id}', [
				'uses' => 'TransactionController@getUpdateTransaction',
				'as' => 'update-transaction'
		]);
		
		Route::post('/do-update-transaction/{transaction_id}', [
				'uses' => 'TransactionController@postDoUpdateTransaction',
				'as' => 'do-update-transaction'
		]);
	});

});