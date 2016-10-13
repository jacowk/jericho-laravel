<?php
/* ****************************** Area Routes ****************************** */

/* Search Areas */
Route::get('/search-area', [
		'uses' => 'AreaController@getSearchArea',
		'as' => 'search-area'
])->middleware('auth', 'permission:VIEW_AREA');

Route::post('/search-area', [
		'uses' => 'AreaController@getSearchArea',
		'as' => 'search-area'
])->middleware('auth', 'permission:VIEW_AREA');

Route::post('/do-search-area', [
		'uses' => 'AreaController@postDoSearchArea',
		'as' => 'do-search-area'
])->middleware('auth', 'permission:VIEW_AREA');

/* Add an Area */
Route::post('/add-area', [
		'uses' => 'AreaController@getAddArea',
		'as' => 'add-area'
])->middleware('auth', 'permission:ADD_AREA');

Route::get('/add-area', [
		'uses' => 'AreaController@getAddArea',
		'as' => 'add-area'
])->middleware('auth', 'permission:ADD_AREA');

Route::post('/do-add-area', [
		'uses' => 'AreaController@postDoAddArea',
		'as' => 'do-add-area'
])->middleware('auth', 'permission:ADD_AREA');

/* Update an Area */
Route::get('/update-area/{area_id}', [
		'uses' => 'AreaController@getUpdateArea',
		'as' => 'update-area'
])->middleware('auth', 'permission:UPDATE_AREA');

Route::post('/update-area/{area_id}', [
		'uses' => 'AreaController@getUpdateArea',
		'as' => 'update-area'
])->middleware('auth', 'permission:UPDATE_AREA');

Route::post('/do-update-area/{area_id}', [
		'uses' => 'AreaController@postDoUpdateArea',
		'as' => 'do-update-area'
])->middleware('auth', 'permission:UPDATE_AREA');

/* View Area */
Route::get('/view-area/{area_id}', [
		'uses' => 'AreaController@getViewArea',
		'as' => 'view-area'
])->middleware('auth', 'permission:VIEW_AREA');

Route::post('/view-area/{area_id}', [
		'uses' => 'AreaController@getViewArea',
		'as' => 'view-area'
])->middleware('auth', 'permission:VIEW_AREA');