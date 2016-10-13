<?php
/* ****************************** Title Routes ****************************** */

/* Search Titles */
Route::get('/search-title', [
		'uses' => 'TitleController@getSearchTitle',
		'as' => 'search-title'
])->middleware('auth', 'permission:VIEW_TITLE');

Route::post('/search-title', [
		'uses' => 'TitleController@getSearchTitle',
		'as' => 'search-title'
])->middleware('auth', 'permission:VIEW_TITLE');

Route::post('/do-search-title', [
		'uses' => 'TitleController@postDoSearchTitle',
		'as' => 'do-search-title'
])->middleware('auth', 'permission:VIEW_TITLE');

/* Add an Title */
Route::post('/add-title', [
		'uses' => 'TitleController@getAddTitle',
		'as' => 'add-title'
])->middleware('auth', 'permission:ADD_TITLE');

Route::get('/add-title', [
		'uses' => 'TitleController@getAddTitle',
		'as' => 'add-title'
])->middleware('auth', 'permission:ADD_TITLE');

Route::post('/do-add-title', [
		'uses' => 'TitleController@postDoAddTitle',
		'as' => 'do-add-title'
])->middleware('auth', 'permission:ADD_TITLE');

/* Update an Title */
Route::get('/update-title/{title_id}', [
		'uses' => 'TitleController@getUpdateTitle',
		'as' => 'update-title'
])->middleware('auth', 'permission:UPDATE_TITLE');

Route::post('/update-title/{title_id}', [
		'uses' => 'TitleController@getUpdateTitle',
		'as' => 'update-title'
])->middleware('auth', 'permission:UPDATE_TITLE');

Route::post('/do-update-title/{title_id}', [
		'uses' => 'TitleController@postDoUpdateTitle',
		'as' => 'do-update-title'
])->middleware('auth', 'permission:UPDATE_TITLE');

/* View Title */
Route::get('/view-title/{title_id}', [
		'uses' => 'TitleController@getViewTitle',
		'as' => 'view-title'
])->middleware('auth', 'permission:VIEW_TITLE');

Route::post('/view-title/{title_id}', [
		'uses' => 'TitleController@getViewTitle',
		'as' => 'view-title'
])->middleware('auth', 'permission:VIEW_TITLE');