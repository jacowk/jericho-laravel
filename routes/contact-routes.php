<?php
/* ****************************** Contact Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_CONTACT], function() {
		/* Search Contacts */
		Route::get('/search-contact', [
				'uses' => 'ContactController@getSearchContact',
				'as' => 'search-contact'
		]);
		
		Route::post('/search-contact', [
				'uses' => 'ContactController@getSearchContact',
				'as' => 'search-contact'
		]);
		
		Route::post('/do-search-contact', [
				'uses' => 'ContactController@postDoSearchContact',
				'as' => 'do-search-contact'
		]);
		
		/* View Contact */
		Route::get('/view-contact/{contact_id}', [
				'uses' => 'ContactController@getViewContact',
				'as' => 'view-contact'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_CONTACT], function() {
		/* Add an Contact */
		Route::post('/add-contact', [
				'uses' => 'ContactController@getAddContact',
				'as' => 'add-contact'
		]);
		
		Route::post('/do-add-contact', [
				'uses' => 'ContactController@postDoAddContact',
				'as' => 'do-add-contact'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_CONTACT], function() {
		/* Update an Contact */
		Route::get('/update-contact/{contact_id}', [
				'uses' => 'ContactController@getUpdateContact',
				'as' => 'update-contact'
		]);
		
		Route::post('/update-contact/{contact_id}', [
				'uses' => 'ContactController@getUpdateContact',
				'as' => 'update-contact'
		]);
		
		Route::post('/do-update-contact/{contact_id}', [
				'uses' => 'ContactController@postDoUpdateContact',
				'as' => 'do-update-contact'
		]);
	});

});
