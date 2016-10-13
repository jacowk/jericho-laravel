<?php
/* ****************************** Greater Area Routes ****************************** */

/* Search Greater Areas */
Route::get('/search-greater-area', [
		'uses' => 'GreaterAreaController@getSearchGreaterArea',
		'as' => 'search-greater-area'
])->middleware('auth', 'permission:VIEW_GREATER_AREA');

Route::post('/search-greater-area', [
		'uses' => 'GreaterAreaController@getSearchGreaterArea',
		'as' => 'search-greater-area'
])->middleware('auth', 'permission:VIEW_GREATER_AREA');

Route::post('/do-search-greater-area', [
		'uses' => 'GreaterAreaController@postDoSearchGreaterArea',
		'as' => 'do-search-greater-area'
])->middleware('auth', 'permission:VIEW_GREATER_AREA');

/* Add an Greater Area */
Route::post('/add-greater-area', [
		'uses' => 'GreaterAreaController@getAddGreaterArea',
		'as' => 'add-greater-area'
])->middleware('auth', 'permission:ADD_GREATER_AREA');

Route::get('/add-greater-area', [
		'uses' => 'GreaterAreaController@getAddGreaterArea',
		'as' => 'add-greater-area'
])->middleware('auth', 'permission:ADD_GREATER_AREA');

Route::post('/do-add-greater-area', [
		'uses' => 'GreaterAreaController@postDoAddGreaterArea',
		'as' => 'do-add-greater-area'
])->middleware('auth', 'permission:ADD_GREATER_AREA');

/* Update an Greater Area */
Route::get('/update-greater-area/{greater_area_id}', [
		'uses' => 'GreaterAreaController@getUpdateGreaterArea',
		'as' => 'update-greater-area'
])->middleware('auth', 'permission:UPDATE_GREATER_AREA');

Route::post('/update-greater-area/{greater_area_id}', [
		'uses' => 'GreaterAreaController@getUpdateGreaterArea',
		'as' => 'update-greater-area'
])->middleware('auth', 'permission:UPDATE_GREATER_AREA');

Route::post('/do-update-greater-area/{greater_area_id}', [
		'uses' => 'GreaterAreaController@postDoUpdateGreaterArea',
		'as' => 'do-update-greater-area'
])->middleware('auth', 'permission:UPDATE_GREATER_AREA');

/* View Greater Area */
Route::get('/view-greater-area/{greater_area_id}', [
		'uses' => 'GreaterAreaController@getViewGreaterArea',
		'as' => 'view-greater-area'
])->middleware('auth', 'permission:VIEW_GREATER_AREA');

Route::post('/view-greater-area/{greater_area_id}', [
		'uses' => 'GreaterAreaController@getViewGreaterArea',
		'as' => 'view-greater-area'
])->middleware('auth', 'permission:VIEW_GREATER_AREA');