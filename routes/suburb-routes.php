<?php
/* ****************************** Suburb Routes ****************************** */

/* Search Suburbs */
Route::get('/search-suburb', [
		'uses' => 'SuburbController@getSearchSuburb',
		'as' => 'search-suburb'
])->middleware('auth', 'permission:VIEW_SUBURB');

Route::post('/search-suburb', [
		'uses' => 'SuburbController@getSearchSuburb',
		'as' => 'search-suburb'
])->middleware('auth', 'permission:VIEW_SUBURB');

Route::post('/do-search-suburb', [
		'uses' => 'SuburbController@postDoSearchSuburb',
		'as' => 'do-search-suburb'
])->middleware('auth', 'permission:VIEW_SUBURB');

/* Add an Suburb */
Route::post('/add-suburb', [
		'uses' => 'SuburbController@getAddSuburb',
		'as' => 'add-suburb'
])->middleware('auth', 'permission:ADD_SUBURB');

Route::get('/add-suburb', [
		'uses' => 'SuburbController@getAddSuburb',
		'as' => 'add-suburb'
])->middleware('auth', 'permission:ADD_SUBURB');

Route::post('/do-add-suburb', [
		'uses' => 'SuburbController@postDoAddSuburb',
		'as' => 'do-add-suburb'
])->middleware('auth', 'permission:ADD_SUBURB');

/* Update an Suburb */
Route::get('/update-suburb/{suburb_id}', [
		'uses' => 'SuburbController@getUpdateSuburb',
		'as' => 'update-suburb'
])->middleware('auth', 'permission:UPDATE_SUBURB');

Route::post('/update-suburb/{suburb_id}', [
		'uses' => 'SuburbController@getUpdateSuburb',
		'as' => 'update-suburb'
])->middleware('auth', 'permission:UPDATE_SUBURB');

Route::post('/do-update-suburb/{suburb_id}', [
		'uses' => 'SuburbController@postDoUpdateSuburb',
		'as' => 'do-update-suburb'
])->middleware('auth', 'permission:UPDATE_SUBURB');

/* View Suburb */
Route::get('/view-suburb/{suburb_id}', [
		'uses' => 'SuburbController@getViewSuburb',
		'as' => 'view-suburb'
])->middleware('auth', 'permission:VIEW_SUBURB');

Route::get('/view-suburb/{suburb_id}', [
		'uses' => 'SuburbController@getViewSuburb',
		'as' => 'view-suburb'
])->middleware('auth', 'permission:VIEW_SUBURB');

/* Suburb Ajax to get areas */
Route::get('/autocomplete-areas', [
		'uses' => 'SuburbController@autocompleteAreas',
		'as' => 'autocomplete-areas'
]);