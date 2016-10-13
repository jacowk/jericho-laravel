<?php
/* ****************************** Role Routes ****************************** */

/* Search Roles */
Route::get('/search-role', [
		'uses' => 'RoleController@getSearchRole',
		'as' => 'search-role'
])->middleware('auth', 'permission:VIEW_ROLE');

Route::post('/search-role', [
		'uses' => 'RoleController@getSearchRole',
		'as' => 'search-role'
])->middleware('auth', 'permission:VIEW_ROLE');

Route::post('/do-search-role', [
		'uses' => 'RoleController@postDoSearchRole',
		'as' => 'do-search-role'
])->middleware('auth', 'permission:VIEW_ROLE');

/* Add an Role */
Route::post('/add-role', [
		'uses' => 'RoleController@getAddRole',
		'as' => 'add-role'
])->middleware('auth', 'permission:ADD_ROLE');

Route::get('/add-role', [
		'uses' => 'RoleController@getAddRole',
		'as' => 'add-role'
])->middleware('auth', 'permission:ADD_ROLE');

Route::post('/do-add-role', [
		'uses' => 'RoleController@postDoAddRole',
		'as' => 'do-add-role'
])->middleware('auth', 'permission:ADD_ROLE');

/* Update an Role */
Route::get('/update-role/{role_id}', [
		'uses' => 'RoleController@getUpdateRole',
		'as' => 'update-role'
])->middleware('auth', 'permission:UPDATE_ROLE');

Route::post('/update-role/{role_id}', [
		'uses' => 'RoleController@getUpdateRole',
		'as' => 'update-role'
])->middleware('auth', 'permission:UPDATE_ROLE');

Route::post('/do-update-role/{role_id}', [
		'uses' => 'RoleController@postDoUpdateRole',
		'as' => 'do-update-role'
])->middleware('auth', 'permission:UPDATE_ROLE');

/* View Role */
Route::get('/view-role/{role_id}', [
		'uses' => 'RoleController@getViewRole',
		'as' => 'view-role'
])->middleware('auth', 'permission:VIEW_ROLE');

Route::post('/view-role/{role_id}', [
		'uses' => 'RoleController@getViewRole',
		'as' => 'view-role'
])->middleware('auth', 'permission:VIEW_ROLE');