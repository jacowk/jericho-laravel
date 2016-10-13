<?php
/* ****************************** Marital Status Routes ****************************** */

/* Search Marital Statuses */
Route::get('/search-marital-status', [
		'uses' => 'MaritalStatusController@getSearchMaritalStatus',
		'as' => 'search-marital-status'
])->middleware('auth', 'permission:VIEW_MARITAL_STATUS');

Route::post('/search-marital-status', [
		'uses' => 'MaritalStatusController@getSearchMaritalStatus',
		'as' => 'search-marital-status'
])->middleware('auth', 'permission:VIEW_MARITAL_STATUS');

Route::post('/do-search-marital-status', [
		'uses' => 'MaritalStatusController@postDoSearchMaritalStatus',
		'as' => 'do-search-marital-status'
])->middleware('auth', 'permission:VIEW_MARITAL_STATUS');

/* Add an Marital Status */
Route::post('/add-marital-status', [
		'uses' => 'MaritalStatusController@getAddMaritalStatus',
		'as' => 'add-marital-status'
])->middleware('auth', 'permission:ADD_MARITAL_STATUS');

Route::get('/add-marital-status', [
		'uses' => 'MaritalStatusController@getAddMaritalStatus',
		'as' => 'add-marital-status'
])->middleware('auth', 'permission:ADD_MARITAL_STATUS');

Route::post('/do-add-marital-status', [
		'uses' => 'MaritalStatusController@postDoAddMaritalStatus',
		'as' => 'do-add-marital-status'
])->middleware('auth', 'permission:ADD_MARITAL_STATUS');

/* Update an Marital Status */
Route::get('/update-marital-status/{marital_status_id}', [
		'uses' => 'MaritalStatusController@getUpdateMaritalStatus',
		'as' => 'update-marital-status'
])->middleware('auth', 'permission:UPDATE_MARITAL_STATUS');

Route::post('/update-marital-status/{marital_status_id}', [
		'uses' => 'MaritalStatusController@getUpdateMaritalStatus',
		'as' => 'update-marital-status'
])->middleware('auth', 'permission:UPDATE_MARITAL_STATUS');

Route::post('/do-update-marital-status/{marital_status_id}', [
		'uses' => 'MaritalStatusController@postDoUpdateMaritalStatus',
		'as' => 'do-update-marital-status'
])->middleware('auth', 'permission:UPDATE_MARITAL_STATUS');

/* View Marital Status */
Route::get('/view-marital-status/{marital_status_id}', [
		'uses' => 'MaritalStatusController@getViewMaritalStatus',
		'as' => 'view-marital-status'
])->middleware('auth', 'permission:VIEW_MARITAL_STATUS');

Route::post('/view-marital-status/{marital_status_id}', [
		'uses' => 'MaritalStatusController@getViewMaritalStatus',
		'as' => 'view-marital-status'
])->middleware('auth', 'permission:VIEW_MARITAL_STATUS');
