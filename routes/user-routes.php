<?php
/* ****************************** User Routes ****************************** */

/* Search Users */
Route::get('/search-user', [
		'uses' => 'UserController@getSearchUser',
		'as' => 'search-user'
])->middleware('auth', 'permission:VIEW_USER');

Route::post('/search-user', [
		'uses' => 'UserController@getSearchUser',
		'as' => 'search-user'
])->middleware('auth', 'permission:VIEW_USER');

Route::post('/do-search-user', [
		'uses' => 'UserController@postDoSearchUser',
		'as' => 'do-search-user'
])->middleware('auth', 'permission:VIEW_USER');

/* Add an User */
Route::post('/add-user', [
		'uses' => 'UserController@getAddUser',
		'as' => 'add-user'
])->middleware('auth', 'permission:ADD_USER');

Route::get('/add-user', [
		'uses' => 'UserController@getAddUser',
		'as' => 'add-user'
])->middleware('auth', 'permission:ADD_USER');

Route::post('/do-add-user', [
		'uses' => 'UserController@postDoAddUser',
		'as' => 'do-add-user'
])->middleware('auth', 'permission:ADD_USER');

/* Update an User */
Route::get('/update-user/{user_id}', [
		'uses' => 'UserController@getUpdateUser',
		'as' => 'update-user'
])->middleware('auth', 'permission:UPDATE_USER');

Route::post('/update-user/{user_id}', [
		'uses' => 'UserController@getUpdateUser',
		'as' => 'update-user'
])->middleware('auth', 'permission:UPDATE_USER');

Route::post('/do-update-user/{user_id}', [
		'uses' => 'UserController@postDoUpdateUser',
		'as' => 'do-update-user'
])->middleware('auth', 'permission:UPDATE_USER');

/* View User */
Route::get('/view-user/{user_id}', [
		'uses' => 'UserController@getViewUser',
		'as' => 'view-user'
])->middleware('auth', 'permission:VIEW_USER');

Route::post('/view-user/{user_id}', [
		'uses' => 'UserController@getViewUser',
		'as' => 'view-user'
])->middleware('auth', 'permission:VIEW_USER');