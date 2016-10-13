<?php
/* ****************************** Property Routes ****************************** */

/* Search Properties */
Route::get('/search-property', [
		'uses' => 'PropertyController@getSearchProperty',
		'as' => 'search-property'
])->middleware('auth', 'permission:VIEW_PROPERTY');

Route::post('/search-property', [
		'uses' => 'PropertyController@getSearchProperty',
		'as' => 'search-property'
])->middleware('auth', 'permission:VIEW_PROPERTY');

Route::post('/do-search-property', [
		'uses' => 'PropertyController@postDoSearchProperty',
		'as' => 'do-search-property'
])->middleware('auth', 'permission:VIEW_PROPERTY');

/* Add an Property */
Route::post('/add-property', [
		'uses' => 'PropertyController@getAddProperty',
		'as' => 'add-property'
])->middleware('auth', 'permission:ADD_PROPERTY');

Route::get('/add-property', [
		'uses' => 'PropertyController@getAddProperty',
		'as' => 'add-property'
])->middleware('auth', 'permission:ADD_PROPERTY');

Route::post('/do-add-property', [
		'uses' => 'PropertyController@postDoAddProperty',
		'as' => 'do-add-property'
])->middleware('auth', 'permission:ADD_PROPERTY');

/* Update an Property */
Route::get('/update-property/{property_id}', [
		'uses' => 'PropertyController@getUpdateProperty',
		'as' => 'update-property'
])->middleware('auth', 'permission:UPDATE_PROPERTY');

Route::post('/update-property/{property_id}', [
		'uses' => 'PropertyController@getUpdateProperty',
		'as' => 'update-property'
])->middleware('auth', 'permission:UPDATE_PROPERTY');

Route::post('/do-update-property/{property_id}', [
		'uses' => 'PropertyController@postDoUpdateProperty',
		'as' => 'do-update-property'
])->middleware('auth', 'permission:UPDATE_PROPERTY');

/* View Property */
Route::get('/view-property/{property_id}', [
		'uses' => 'PropertyController@getViewProperty',
		'as' => 'view-property'
])->middleware('auth', 'permission:VIEW_PROPERTY');

Route::post('/view-property/{property_id}', [
		'uses' => 'PropertyController@getViewProperty',
		'as' => 'view-property'
])->middleware('auth', 'permission:VIEW_PROPERTY');