<?php
/* ****************************** Permission Routes ****************************** */

/* Search Permissions */
Route::get('/search-permission', [
		'uses' => 'PermissionController@getSearchPermission',
		'as' => 'search-permission'
])->middleware('auth', 'permission:VIEW_PERMISSION');

Route::post('/search-permission', [
		'uses' => 'PermissionController@getSearchPermission',
		'as' => 'search-permission'
])->middleware('auth', 'permission:VIEW_PERMISSION');

Route::post('/do-search-permission', [
		'uses' => 'PermissionController@postDoSearchPermission',
		'as' => 'do-search-permission'
])->middleware('auth', 'permission:VIEW_PERMISSION');

/* Add an Permission */
Route::post('/add-permission', [
		'uses' => 'PermissionController@getAddPermission',
		'as' => 'add-permission'
])->middleware('auth', 'permission:ADD_PERMISSION');

Route::get('/add-permission', [
		'uses' => 'PermissionController@getAddPermission',
		'as' => 'add-permission'
])->middleware('auth', 'permission:ADD_PERMISSION');

Route::post('/do-add-permission', [
		'uses' => 'PermissionController@postDoAddPermission',
		'as' => 'do-add-permission'
])->middleware('auth', 'permission:ADD_PERMISSION');

/* Update an Permission */
Route::get('/update-permission/{permission_id}', [
		'uses' => 'PermissionController@getUpdatePermission',
		'as' => 'update-permission'
])->middleware('auth', 'permission:UPDATE_PERMISSION');

Route::post('/update-permission/{permission_id}', [
		'uses' => 'PermissionController@getUpdatePermission',
		'as' => 'update-permission'
])->middleware('auth', 'permission:UPDATE_PERMISSION');

Route::post('/do-update-permission/{permission_id}', [
		'uses' => 'PermissionController@postDoUpdatePermission',
		'as' => 'do-update-permission'
])->middleware('auth', 'permission:UPDATE_PERMISSION');

/* View Permission */
Route::get('/view-permission/{permission_id}', [
		'uses' => 'PermissionController@getViewPermission',
		'as' => 'view-permission'
])->middleware('auth', 'permission:VIEW_PERMISSION');

Route::post('/view-permission/{permission_id}', [
		'uses' => 'PermissionController@getViewPermission',
		'as' => 'view-permission'
])->middleware('auth', 'permission:VIEW_PERMISSION');