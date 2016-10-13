<?php
/* ****************************** Attorney Type Routes ****************************** */

/* Search Attorney Typees */
Route::get('/search-attorney-type', [
		'uses' => 'AttorneyTypeController@getSearchAttorneyType',
		'as' => 'search-attorney-type'
])->middleware('auth', 'permission:VIEW_ATTORNEY_TYPE');

Route::post('/search-attorney-type', [
		'uses' => 'AttorneyTypeController@getSearchAttorneyType',
		'as' => 'search-attorney-type'
])->middleware('auth', 'permission:VIEW_ATTORNEY_TYPE');

Route::post('/do-search-attorney-type', [
		'uses' => 'AttorneyTypeController@postDoSearchAttorneyType',
		'as' => 'do-search-attorney-type'
])->middleware('auth', 'permission:VIEW_ATTORNEY_TYPE');

/* Add an Attorney Type */
Route::post('/add-attorney-type', [
		'uses' => 'AttorneyTypeController@getAddAttorneyType',
		'as' => 'add-attorney-type'
])->middleware('auth', 'permission:ADD_ATTORNEY_TYPE');

Route::get('/add-attorney-type', [
		'uses' => 'AttorneyTypeController@getAddAttorneyType',
		'as' => 'add-attorney-type'
])->middleware('auth', 'permission:ADD_ATTORNEY_TYPE');

Route::post('/do-add-attorney-type', [
		'uses' => 'AttorneyTypeController@postDoAddAttorneyType',
		'as' => 'do-add-attorney-type'
])->middleware('auth', 'permission:ADD_ATTORNEY_TYPE');

/* Update an Attorney Type */
Route::get('/update-attorney-type/{attorney_type_id}', [
		'uses' => 'AttorneyTypeController@getUpdateAttorneyType',
		'as' => 'update-attorney-type'
])->middleware('auth', 'permission:UPDATE_ATTORNEY_TYPE');

Route::post('/update-attorney-type/{attorney_type_id}', [
		'uses' => 'AttorneyTypeController@getUpdateAttorneyType',
		'as' => 'update-attorney-type'
])->middleware('auth', 'permission:UPDATE_ATTORNEY_TYPE');

Route::post('/do-update-attorney-type/{attorney_type_id}', [
		'uses' => 'AttorneyTypeController@postDoUpdateAttorneyType',
		'as' => 'do-update-attorney-type'
])->middleware('auth', 'permission:UPDATE_ATTORNEY_TYPE');

/* View Attorney Type */
Route::get('/view-attorney-type/{attorney_type_id}', [
		'uses' => 'AttorneyTypeController@getViewAttorneyType',
		'as' => 'view-attorney-type'
])->middleware('auth', 'permission:VIEW_ATTORNEY_TYPE');

Route::post('/view-attorney-type/{attorney_type_id}', [
		'uses' => 'AttorneyTypeController@getViewAttorneyType',
		'as' => 'view-attorney-type'
])->middleware('auth', 'permission:VIEW_ATTORNEY_TYPE');