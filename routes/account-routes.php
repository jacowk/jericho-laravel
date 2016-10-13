<?php
/* ****************************** Account Routes ****************************** */

/* Search Accounts */
Route::get('/search-account', [
		'uses' => 'AccountController@getSearchAccount',
		'as' => 'search-account'
])->middleware('auth', 'permission:VIEW_ACCOUNT');

Route::post('/search-account', [
		'uses' => 'AccountController@getSearchAccount',
		'as' => 'search-account'
])->middleware('auth', 'permission:VIEW_ACCOUNT');

Route::post('/do-search-account', [
		'uses' => 'AccountController@postDoSearchAccount',
		'as' => 'do-search-account'
])->middleware('auth', 'permission:VIEW_ACCOUNT');

/* Add an Account */
Route::post('/add-account', [
		'uses' => 'AccountController@getAddAccount',
		'as' => 'add-account'
])->middleware('auth', 'permission:ADD_ACCOUNT');

Route::get('/add-account', [
		'uses' => 'AccountController@getAddAccount',
		'as' => 'add-account'
])->middleware('auth', 'permission:ADD_ACCOUNT');

Route::post('/do-add-account', [
		'uses' => 'AccountController@postDoAddAccount',
		'as' => 'do-add-account'
])->middleware('auth', 'permission:ADD_ACCOUNT');

/* Update an Account */
Route::get('/update-account/{account_id}', [
		'uses' => 'AccountController@getUpdateAccount',
		'as' => 'update-account'
])->middleware('auth', 'permission:UPDATE_ACCOUNT');

Route::post('/update-account/{account_id}', [
		'uses' => 'AccountController@getUpdateAccount',
		'as' => 'update-account'
])->middleware('auth', 'permission:UPDATE_ACCOUNT');

Route::post('/do-update-account/{account_id}', [
		'uses' => 'AccountController@postDoUpdateAccount',
		'as' => 'do-update-account'
])->middleware('auth', 'permission:UPDATE_ACCOUNT');

/* View Account */
Route::get('/view-account/{account_id}', [
		'uses' => 'AccountController@getViewAccount',
		'as' => 'view-account'
])->middleware('auth', 'permission:VIEW_ACCOUNT');

Route::post('/view-account/{account_id}', [
		'uses' => 'AccountController@getViewAccount',
		'as' => 'view-account'
])->middleware('auth', 'permission:VIEW_ACCOUNT');