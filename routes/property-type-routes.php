<?php
/* ****************************** Property Type Routes ****************************** */

/* Search Property Types */
Route::get('/search-property-type', [
		'uses' => 'PropertyTypeController@getSearchPropertyType',
		'as' => 'search-property-type'
])->middleware('auth', 'permission:VIEW_PROPERTY_TYPE');

Route::post('/search-property-type', [
		'uses' => 'PropertyTypeController@getSearchPropertyType',
		'as' => 'search-property-type'
])->middleware('auth', 'permission:VIEW_PROPERTY_TYPE');

Route::post('/do-search-property-type', [
		'uses' => 'PropertyTypeController@postDoSearchPropertyType',
		'as' => 'do-search-property-type'
])->middleware('auth', 'permission:VIEW_PROPERTY_TYPE');

/* Add an Property Type */
Route::post('/add-property-type', [
		'uses' => 'PropertyTypeController@getAddPropertyType',
		'as' => 'add-property-type'
])->middleware('auth', 'permission:ADD_PROPERTY_TYPE');

Route::get('/add-property-type', [
		'uses' => 'PropertyTypeController@getAddPropertyType',
		'as' => 'add-property-type'
])->middleware('auth', 'permission:ADD_PROPERTY_TYPE');

Route::post('/do-add-property-type', [
		'uses' => 'PropertyTypeController@postDoAddPropertyType',
		'as' => 'do-add-property-type'
])->middleware('auth', 'permission:ADD_PROPERTY_TYPE');

/* Update an Property Type */
Route::get('/update-property-type/{property_type_id}', [
		'uses' => 'PropertyTypeController@getUpdatePropertyType',
		'as' => 'update-property-type'
])->middleware('auth', 'permission:UPDATE_PROPERTY_TYPE');

Route::post('/update-property-type/{property_type_id}', [
		'uses' => 'PropertyTypeController@getUpdatePropertyType',
		'as' => 'update-property-type'
])->middleware('auth', 'permission:UPDATE_PROPERTY_TYPE');

Route::post('/do-update-property-type/{property_type_id}', [
		'uses' => 'PropertyTypeController@postDoUpdatePropertyType',
		'as' => 'do-update-property-type'
])->middleware('auth', 'permission:UPDATE_PROPERTY_TYPE');

/* View Property Type */
Route::get('/view-property-type/{property_type_id}', [
		'uses' => 'PropertyTypeController@getViewPropertyType',
		'as' => 'view-property-type'
])->middleware('auth', 'permission:VIEW_PROPERTY_TYPE');

Route::post('/view-property-type/{property_type_id}', [
		'uses' => 'PropertyTypeController@getViewPropertyType',
		'as' => 'view-property-type'
])->middleware('auth', 'permission:VIEW_PROPERTY_TYPE');
