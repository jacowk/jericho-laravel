<?php
/* ****************************** Property Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_PROPERTY], function() {
		/* Search Properties */
		Route::get('/search-property', [
				'uses' => 'PropertyController@getSearchProperty',
				'as' => 'search-property'
		]);
		
		Route::post('/search-property', [
				'uses' => 'PropertyController@getSearchProperty',
				'as' => 'search-property'
		]);
		
		/* Pagination */
		Route::get('/do-search-property', [
				'uses' => 'PropertyController@postDoSearchProperty',
				'as' => 'do-search-property'
		]);
		
		Route::post('/do-search-property', [
				'uses' => 'PropertyController@postDoSearchProperty',
				'as' => 'do-search-property'
		]);
		
		/* View Property */
		Route::get('/view-property/{property_id}', [
				'uses' => 'PropertyController@getViewProperty',
				'as' => 'view-property'
		]);
		
		Route::post('/view-property/{property_id}', [
				'uses' => 'PropertyController@getViewProperty',
				'as' => 'view-property'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_PROPERTY], function() {
		/* Add an Property */
		Route::post('/add-property', [
				'uses' => 'PropertyController@getAddProperty',
				'as' => 'add-property'
		]);
		
		Route::get('/add-property', [
				'uses' => 'PropertyController@getAddProperty',
				'as' => 'add-property'
		]);
		
		Route::post('/do-add-property', [
				'uses' => 'PropertyController@postDoAddProperty',
				'as' => 'do-add-property'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_PROPERTY], function() {
		/* Update an Property */
		Route::get('/update-property/{property_id}', [
				'uses' => 'PropertyController@getUpdateProperty',
				'as' => 'update-property'
		]);
		
		Route::post('/update-property/{property_id}', [
				'uses' => 'PropertyController@getUpdateProperty',
				'as' => 'update-property'
		]);
		
		Route::post('/do-update-property/{property_id}', [
				'uses' => 'PropertyController@postDoUpdateProperty',
				'as' => 'do-update-property'
		]);
	});

});