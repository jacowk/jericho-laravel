<?php
/* ****************************** Property Type Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_PROPERTY_TYPE], function() {
		/* Search Property Types */
		Route::get('/search-property-type', [
				'uses' => 'PropertyTypeController@getSearchPropertyType',
				'as' => 'search-property-type'
		]);
		
		Route::post('/search-property-type', [
				'uses' => 'PropertyTypeController@getSearchPropertyType',
				'as' => 'search-property-type'
		]);
		
		/* Pagination */
		Route::get('/do-search-property-type', [
				'uses' => 'PropertyTypeController@postDoSearchPropertyType',
				'as' => 'do-search-property-type'
		]);
		
		Route::post('/do-search-property-type', [
				'uses' => 'PropertyTypeController@postDoSearchPropertyType',
				'as' => 'do-search-property-type'
		]);
		
		/* View Property Type */
		Route::get('/view-property-type/{property_type_id}', [
				'uses' => 'PropertyTypeController@getViewPropertyType',
				'as' => 'view-property-type'
		]);
		
		Route::post('/view-property-type/{property_type_id}', [
				'uses' => 'PropertyTypeController@getViewPropertyType',
				'as' => 'view-property-type'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_PROPERTY_TYPE], function() {
		/* Add an Property Type */
		Route::post('/add-property-type', [
				'uses' => 'PropertyTypeController@getAddPropertyType',
				'as' => 'add-property-type'
		]);
		
		Route::get('/add-property-type', [
				'uses' => 'PropertyTypeController@getAddPropertyType',
				'as' => 'add-property-type'
		]);
		
		Route::post('/do-add-property-type', [
				'uses' => 'PropertyTypeController@postDoAddPropertyType',
				'as' => 'do-add-property-type'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_PROPERTY_TYPE], function() {
		/* Update an Property Type */
		Route::get('/update-property-type/{property_type_id}', [
				'uses' => 'PropertyTypeController@getUpdatePropertyType',
				'as' => 'update-property-type'
		]);
		
		Route::post('/update-property-type/{property_type_id}', [
				'uses' => 'PropertyTypeController@getUpdatePropertyType',
				'as' => 'update-property-type'
		]);
		
		Route::post('/do-update-property-type/{property_type_id}', [
				'uses' => 'PropertyTypeController@postDoUpdatePropertyType',
				'as' => 'do-update-property-type'
		]);
	});

});