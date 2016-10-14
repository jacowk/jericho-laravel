<?php
/* ****************************** Suburb Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_SUBURB], function() {
		/* Search Suburbs */
		Route::get('/search-suburb', [
				'uses' => 'SuburbController@getSearchSuburb',
				'as' => 'search-suburb'
		]);
		
		Route::post('/search-suburb', [
				'uses' => 'SuburbController@getSearchSuburb',
				'as' => 'search-suburb'
		]);
		
		Route::post('/do-search-suburb', [
				'uses' => 'SuburbController@postDoSearchSuburb',
				'as' => 'do-search-suburb'
		]);
		
		/* View Suburb */
		Route::get('/view-suburb/{suburb_id}', [
				'uses' => 'SuburbController@getViewSuburb',
				'as' => 'view-suburb'
		]);
		
		Route::get('/view-suburb/{suburb_id}', [
				'uses' => 'SuburbController@getViewSuburb',
				'as' => 'view-suburb'
		]);
		
		/* Suburb Ajax to get areas */
		Route::get('/autocomplete-areas', [
				'uses' => 'SuburbController@autocompleteAreas',
				'as' => 'autocomplete-areas'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_SUBURB], function() {
		/* Add an Suburb */
		Route::post('/add-suburb', [
				'uses' => 'SuburbController@getAddSuburb',
				'as' => 'add-suburb'
		]);
		
		Route::get('/add-suburb', [
				'uses' => 'SuburbController@getAddSuburb',
				'as' => 'add-suburb'
		]);
		
		Route::post('/do-add-suburb', [
				'uses' => 'SuburbController@postDoAddSuburb',
				'as' => 'do-add-suburb'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_SUBURB], function() {
		/* Update an Suburb */
		Route::get('/update-suburb/{suburb_id}', [
				'uses' => 'SuburbController@getUpdateSuburb',
				'as' => 'update-suburb'
		]);
		
		Route::post('/update-suburb/{suburb_id}', [
				'uses' => 'SuburbController@getUpdateSuburb',
				'as' => 'update-suburb'
		]);
		
		Route::post('/do-update-suburb/{suburb_id}', [
				'uses' => 'SuburbController@postDoUpdateSuburb',
				'as' => 'do-update-suburb'
		]);
	});

});