<?php
/* ****************************** Note Routes ****************************** */

/* Add an Note */
Route::post('/add-note/{property_flip_id}', [
		'uses' => 'NoteController@getAddNote',
		'as' => 'add-note'
])->middleware('auth', 'permission:ADD_NOTE');

Route::get('/add-note/{property_flip_id}', [
		'uses' => 'NoteController@getAddNote',
		'as' => 'add-note'
])->middleware('auth', 'permission:ADD_NOTE');

Route::post('/do-add-note', [
		'uses' => 'NoteController@postDoAddNote',
		'as' => 'do-add-note'
])->middleware('auth', 'permission:ADD_NOTE');

/* Update an Note */
Route::get('/update-note/{note_id}', [
		'uses' => 'NoteController@getUpdateNote',
		'as' => 'update-note'
])->middleware('auth', 'permission:UPDATE_NOTE');

Route::post('/update-note/{note_id}', [
		'uses' => 'NoteController@getUpdateNote',
		'as' => 'update-note'
])->middleware('auth', 'permission:UPDATE_NOTE');

Route::post('/do-update-note/{note_id}', [
		'uses' => 'NoteController@postDoUpdateNote',
		'as' => 'do-update-note'
])->middleware('auth', 'permission:UPDATE_NOTE');

/* View Note */
Route::get('/view-note/{note_id}', [
		'uses' => 'NoteController@getViewNote',
		'as' => 'view-note'
])->middleware('auth', 'permission:VIEW_NOTE');

Route::post('/view-note/{note_id}', [
		'uses' => 'NoteController@getViewNote',
		'as' => 'view-note'
])->middleware('auth', 'permission:VIEW_NOTE');