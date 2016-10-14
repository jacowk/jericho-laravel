<?php
/* ****************************** Title Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_TITLE], function() {
		/* Search Titles */
		Route::get('/search-title', [
				'uses' => 'TitleController@getSearchTitle',
				'as' => 'search-title'
		]);
		
		Route::post('/search-title', [
				'uses' => 'TitleController@getSearchTitle',
				'as' => 'search-title'
		]);
		
		Route::post('/do-search-title', [
				'uses' => 'TitleController@postDoSearchTitle',
				'as' => 'do-search-title'
		]);
		
		/* View Title */
		Route::get('/view-title/{title_id}', [
				'uses' => 'TitleController@getViewTitle',
				'as' => 'view-title'
		]);
		
		Route::post('/view-title/{title_id}', [
				'uses' => 'TitleController@getViewTitle',
				'as' => 'view-title'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_TITLE], function() {
		/* Add an Title */
		Route::post('/add-title', [
				'uses' => 'TitleController@getAddTitle',
				'as' => 'add-title'
		]);
		
		Route::get('/add-title', [
				'uses' => 'TitleController@getAddTitle',
				'as' => 'add-title'
		]);
		
		Route::post('/do-add-title', [
				'uses' => 'TitleController@postDoAddTitle',
				'as' => 'do-add-title'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_TITLE], function() {
		/* Update an Title */
		Route::get('/update-title/{title_id}', [
				'uses' => 'TitleController@getUpdateTitle',
				'as' => 'update-title'
		]);
		
		Route::post('/update-title/{title_id}', [
				'uses' => 'TitleController@getUpdateTitle',
				'as' => 'update-title'
		]);
		
		Route::post('/do-update-title/{title_id}', [
				'uses' => 'TitleController@postDoUpdateTitle',
				'as' => 'do-update-title'
		]);
	});

});