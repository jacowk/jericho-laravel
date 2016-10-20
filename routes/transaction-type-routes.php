<?php
/* ****************************** Transaction Type Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_TRANSACTION_TYPE], function() {
		/* Search Transaction Typees */
		Route::get('/search-transaction-type', [
				'uses' => 'TransactionTypeController@getSearchTransactionType',
				'as' => 'search-transaction-type'
		]);
		
		Route::post('/search-transaction-type', [
				'uses' => 'TransactionTypeController@getSearchTransactionType',
				'as' => 'search-transaction-type'
		]);
		
		/* Pagination */
		Route::get('/do-search-transaction-type', [
				'uses' => 'TransactionTypeController@postDoSearchTransactionType',
				'as' => 'do-search-transaction-type'
		]);
		
		Route::post('/do-search-transaction-type', [
				'uses' => 'TransactionTypeController@postDoSearchTransactionType',
				'as' => 'do-search-transaction-type'
		]);
		
		/* View Transaction Type */
		Route::get('/view-transaction-type/{transaction_type_id}', [
				'uses' => 'TransactionTypeController@getViewTransactionType',
				'as' => 'view-transaction-type'
		]);
		
		Route::post('/view-transaction-type/{transaction_type_id}', [
				'uses' => 'TransactionTypeController@getViewTransactionType',
				'as' => 'view-transaction-type'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_TRANSACTION_TYPE], function() {
		/* Add an Transaction Type */
		Route::post('/add-transaction-type', [
				'uses' => 'TransactionTypeController@getAddTransactionType',
				'as' => 'add-transaction-type'
		]);
		
		Route::get('/add-transaction-type', [
				'uses' => 'TransactionTypeController@getAddTransactionType',
				'as' => 'add-transaction-type'
		]);
		
		Route::post('/do-add-transaction-type', [
				'uses' => 'TransactionTypeController@postDoAddTransactionType',
				'as' => 'do-add-transaction-type'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_TRANSACTION_TYPE], function() {
		/* Update an Transaction Type */
		Route::get('/update-transaction-type/{transaction_type_id}', [
				'uses' => 'TransactionTypeController@getUpdateTransactionType',
				'as' => 'update-transaction-type'
		]);
		
		Route::post('/update-transaction-type/{transaction_type_id}', [
				'uses' => 'TransactionTypeController@getUpdateTransactionType',
				'as' => 'update-transaction-type'
		]);
		
		Route::post('/do-update-transaction-type/{transaction_type_id}', [
				'uses' => 'TransactionTypeController@postDoUpdateTransactionType',
				'as' => 'do-update-transaction-type'
		]);
	});

});