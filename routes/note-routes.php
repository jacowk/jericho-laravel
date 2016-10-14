<?php
/* ****************************** Note Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_NOTE], function() {
		/* View Note */
		Route::get('/view-note/{note_id}', [
				'uses' => 'NoteController@getViewNote',
				'as' => 'view-note'
		]);
		
		Route::post('/view-note/{note_id}', [
				'uses' => 'NoteController@getViewNote',
				'as' => 'view-note'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_NOTE], function() {
		/* Add an Note */
		Route::post('/add-note/{property_flip_id}', [
				'uses' => 'NoteController@getAddNote',
				'as' => 'add-note'
		]);
		
		Route::get('/add-note/{property_flip_id}', [
				'uses' => 'NoteController@getAddNote',
				'as' => 'add-note'
		]);
		
		Route::post('/do-add-note', [
				'uses' => 'NoteController@postDoAddNote',
				'as' => 'do-add-note'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_NOTE], function() {
		/* Update an Note */
		Route::get('/update-note/{note_id}', [
				'uses' => 'NoteController@getUpdateNote',
				'as' => 'update-note'
		]);
		
		Route::post('/update-note/{note_id}', [
				'uses' => 'NoteController@getUpdateNote',
				'as' => 'update-note'
		]);
		
		Route::post('/do-update-note/{note_id}', [
				'uses' => 'NoteController@postDoUpdateNote',
				'as' => 'do-update-note'
		]);
	});

});