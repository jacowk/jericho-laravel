<?php
/* ****************************** Contact Routes ****************************** */

/* Search Contacts */
Route::get('/search-contact', [
		'uses' => 'ContactController@getSearchContact',
		'as' => 'search-contact'
])->middleware('auth', 'permission:VIEW_CONTACT');

Route::post('/search-contact', [
		'uses' => 'ContactController@getSearchContact',
		'as' => 'search-contact'
])->middleware('auth', 'permission:VIEW_CONTACT');

Route::post('/do-search-contact', [
		'uses' => 'ContactController@postDoSearchContact',
		'as' => 'do-search-contact'
])->middleware('auth', 'permission:VIEW_CONTACT');

/* Add an Contact */
Route::post('/add-contact', [
		'uses' => 'ContactController@getAddContact',
		'as' => 'add-contact'
])->middleware('auth', 'permission:ADD_CONTACT');

Route::post('/do-add-contact', [
		'uses' => 'ContactController@postDoAddContact',
		'as' => 'do-add-contact'
])->middleware('auth', 'permission:ADD_CONTACT');

/* Update an Contact */
Route::get('/update-contact/{contact_id}', [
		'uses' => 'ContactController@getUpdateContact',
		'as' => 'update-contact'
])->middleware('auth', 'permission:UPDATE_CONTACT');

Route::post('/update-contact/{contact_id}', [
		'uses' => 'ContactController@getUpdateContact',
		'as' => 'update-contact'
])->middleware('auth', 'permission:UPDATE_CONTACT');

Route::post('/do-update-contact/{contact_id}', [
		'uses' => 'ContactController@postDoUpdateContact',
		'as' => 'do-update-contact'
])->middleware('auth', 'permission:UPDATE_CONTACT');

/* View Contact */
Route::get('/view-contact/{contact_id}', [
		'uses' => 'ContactController@getViewContact',
		'as' => 'view-contact'
])->middleware('auth', 'permission:VIEW_CONTACT');