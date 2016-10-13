<?php
/* ****************************** Transaction Type Routes ****************************** */

/* Search Transaction Typees */
Route::get('/search-transaction-type', [
		'uses' => 'TransactionTypeController@getSearchTransactionType',
		'as' => 'search-transaction-type'
])->middleware('auth', 'permission:VIEW_TRANSACTION_TYPE');

Route::post('/search-transaction-type', [
		'uses' => 'TransactionTypeController@getSearchTransactionType',
		'as' => 'search-transaction-type'
])->middleware('auth', 'permission:VIEW_TRANSACTION_TYPE');

Route::post('/do-search-transaction-type', [
		'uses' => 'TransactionTypeController@postDoSearchTransactionType',
		'as' => 'do-search-transaction-type'
])->middleware('auth', 'permission:VIEW_TRANSACTION_TYPE');

/* Add an Transaction Type */
Route::post('/add-transaction-type', [
		'uses' => 'TransactionTypeController@getAddTransactionType',
		'as' => 'add-transaction-type'
])->middleware('auth', 'permission:ADD_TRANSACTION_TYPE');

Route::get('/add-transaction-type', [
		'uses' => 'TransactionTypeController@getAddTransactionType',
		'as' => 'add-transaction-type'
])->middleware('auth', 'permission:ADD_TRANSACTION_TYPE');

Route::post('/do-add-transaction-type', [
		'uses' => 'TransactionTypeController@postDoAddTransactionType',
		'as' => 'do-add-transaction-type'
])->middleware('auth', 'permission:ADD_TRANSACTION_TYPE');

/* Update an Transaction Type */
Route::get('/update-transaction-type/{transaction_type_id}', [
		'uses' => 'TransactionTypeController@getUpdateTransactionType',
		'as' => 'update-transaction-type'
])->middleware('auth', 'permission:UPDATE_TRANSACTION_TYPE');

Route::post('/update-transaction-type/{transaction_type_id}', [
		'uses' => 'TransactionTypeController@getUpdateTransactionType',
		'as' => 'update-transaction-type'
])->middleware('auth', 'permission:UPDATE_TRANSACTION_TYPE');

Route::post('/do-update-transaction-type/{transaction_type_id}', [
		'uses' => 'TransactionTypeController@postDoUpdateTransactionType',
		'as' => 'do-update-transaction-type'
])->middleware('auth', 'permission:UPDATE_TRANSACTION_TYPE');

/* View Transaction Type */
Route::get('/view-transaction-type/{transaction_type_id}', [
		'uses' => 'TransactionTypeController@getViewTransactionType',
		'as' => 'view-transaction-type'
])->middleware('auth', 'permission:VIEW_TRANSACTION_TYPE');

Route::post('/view-transaction-type/{transaction_type_id}', [
		'uses' => 'TransactionTypeController@getViewTransactionType',
		'as' => 'view-transaction-type'
])->middleware('auth', 'permission:VIEW_TRANSACTION_TYPE');