<?php
/* ****************************** Bank Routes ****************************** */

/* Search Banks */
Route::get('/search-bank', [
		'uses' => 'BankController@getSearchBank',
		'as' => 'search-bank'
])->middleware('auth', 'permission:VIEW_BANK');

Route::post('/search-bank', [
		'uses' => 'BankController@getSearchBank',
		'as' => 'search-bank'
])->middleware('auth', 'permission:VIEW_BANK');

Route::post('/do-search-bank', [
		'uses' => 'BankController@postDoSearchBank',
		'as' => 'do-search-bank'
])->middleware('auth', 'permission:VIEW_BANK');

/* Add an Bank */
Route::post('/add-bank', [
		'uses' => 'BankController@getAddBank',
		'as' => 'add-bank'
])->middleware('auth', 'permission:ADD_BANK');

Route::get('/add-bank', [
		'uses' => 'BankController@getAddBank',
		'as' => 'add-bank'
])->middleware('auth', 'permission:ADD_BANK');

Route::post('/do-add-bank', [
		'uses' => 'BankController@postDoAddBank',
		'as' => 'do-add-bank'
])->middleware('auth', 'permission:ADD_BANK');

/* Update an Bank */
Route::get('/update-bank/{bank_id}', [
		'uses' => 'BankController@getUpdateBank',
		'as' => 'update-bank'
])->middleware('auth', 'permission:UPDATE_BANK');

Route::post('/update-bank/{bank_id}', [
		'uses' => 'BankController@getUpdateBank',
		'as' => 'update-bank'
])->middleware('auth', 'permission:UPDATE_BANK');

Route::post('/do-update-bank/{bank_id}', [
		'uses' => 'BankController@postDoUpdateBank',
		'as' => 'do-update-bank'
])->middleware('auth', 'permission:UPDATE_BANK');

/* View Bank */
Route::get('/view-bank/{bank_id}', [
		'uses' => 'BankController@getViewBank',
		'as' => 'view-bank'
])->middleware('auth', 'permission:VIEW_BANK');

Route::post('/view-bank/{bank_id}', [
		'uses' => 'BankController@getViewBank',
		'as' => 'view-bank'
])->middleware('auth', 'permission:VIEW_BANK');