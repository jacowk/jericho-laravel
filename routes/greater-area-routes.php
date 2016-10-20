<?php
/* ****************************** Greater Area Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_GREATER_AREA], function() {
		/* Search Greater Areas */
		Route::get('/search-greater-area', [
				'uses' => 'GreaterAreaController@getSearchGreaterArea',
				'as' => 'search-greater-area'
		]);
		
		Route::post('/search-greater-area', [
				'uses' => 'GreaterAreaController@getSearchGreaterArea',
				'as' => 'search-greater-area'
		]);
		
		/* Pagination */
		Route::get('/do-search-greater-area', [
				'uses' => 'GreaterAreaController@postDoSearchGreaterArea',
				'as' => 'do-search-greater-area'
		]);
		
		Route::post('/do-search-greater-area', [
				'uses' => 'GreaterAreaController@postDoSearchGreaterArea',
				'as' => 'do-search-greater-area'
		]);
		
		/* View Greater Area */
		Route::get('/view-greater-area/{greater_area_id}', [
				'uses' => 'GreaterAreaController@getViewGreaterArea',
				'as' => 'view-greater-area'
		]);
		
		Route::post('/view-greater-area/{greater_area_id}', [
				'uses' => 'GreaterAreaController@getViewGreaterArea',
				'as' => 'view-greater-area'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_GREATER_AREA], function() {
		/* Add an Greater Area */
		Route::post('/add-greater-area', [
				'uses' => 'GreaterAreaController@getAddGreaterArea',
				'as' => 'add-greater-area'
		]);
		
		Route::get('/add-greater-area', [
				'uses' => 'GreaterAreaController@getAddGreaterArea',
				'as' => 'add-greater-area'
		]);
		
		Route::post('/do-add-greater-area', [
				'uses' => 'GreaterAreaController@postDoAddGreaterArea',
				'as' => 'do-add-greater-area'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_GREATER_AREA], function() {
		/* Update an Greater Area */
		Route::get('/update-greater-area/{greater_area_id}', [
				'uses' => 'GreaterAreaController@getUpdateGreaterArea',
				'as' => 'update-greater-area'
		]);
		
		Route::post('/update-greater-area/{greater_area_id}', [
				'uses' => 'GreaterAreaController@getUpdateGreaterArea',
				'as' => 'update-greater-area'
		]);
		
		Route::post('/do-update-greater-area/{greater_area_id}', [
				'uses' => 'GreaterAreaController@postDoUpdateGreaterArea',
				'as' => 'do-update-greater-area'
		]);
	});

});







