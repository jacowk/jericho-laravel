<?php
/* ****************************** Transaction Routes ****************************** */

/* Add an Transaction */
Route::post('/add-transaction/{property_flip_id}', [
		'uses' => 'TransactionController@getAddTransaction',
		'as' => 'add-transaction'
])->middleware('auth', 'permission:ADD_TRANSACTION');

Route::get('/add-transaction/{property_flip_id}', [
		'uses' => 'TransactionController@getAddTransaction',
		'as' => 'add-transaction'
])->middleware('auth', 'permission:ADD_TRANSACTION');

Route::post('/do-add-transaction', [
		'uses' => 'TransactionController@postDoAddTransaction',
		'as' => 'do-add-transaction'
])->middleware('auth', 'permission:ADD_TRANSACTION');

/* Update an Transaction */
Route::get('/update-transaction/{transaction_id}', [
		'uses' => 'TransactionController@getUpdateTransaction',
		'as' => 'update-transaction'
])->middleware('auth', 'permission:UPDATE_TRANSACTION');

Route::post('/update-transaction/{transaction_id}', [
		'uses' => 'TransactionController@getUpdateTransaction',
		'as' => 'update-transaction'
])->middleware('auth', 'permission:UPDATE_TRANSACTION');

Route::post('/do-update-transaction/{transaction_id}', [
		'uses' => 'TransactionController@postDoUpdateTransaction',
		'as' => 'do-update-transaction'
])->middleware('auth', 'permission:UPDATE_TRANSACTION');

/* View Transaction */
Route::get('/view-transaction/{transaction_id}', [
		'uses' => 'TransactionController@getViewTransaction',
		'as' => 'view-transaction'
])->middleware('auth', 'permission:VIEW_TRANSACTION');

Route::post('/view-transaction/{transaction_id}', [
		'uses' => 'TransactionController@getViewTransaction',
		'as' => 'view-transaction'
])->middleware('auth', 'permission:VIEW_TRANSACTION');