<?php
/* ****************************** Permission Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_PERMISSION], function() {

		/* Search Permissions */
		Route::get('/search-permission', [
				'uses' => 'PermissionController@getSearchPermission',
				'as' => 'search-permission'
		]);
		
		Route::post('/search-permission', [
				'uses' => 'PermissionController@getSearchPermission',
				'as' => 'search-permission'
		]);
		
		/* Pagination */
		Route::get('/do-search-permission', [
				'uses' => 'PermissionController@postDoSearchPermission',
				'as' => 'do-search-permission'
		]);
		
		Route::post('/do-search-permission', [
				'uses' => 'PermissionController@postDoSearchPermission',
				'as' => 'do-search-permission'
		]);
		
		/* View Permission */
		Route::get('/view-permission/{permission_id}', [
				'uses' => 'PermissionController@getViewPermission',
				'as' => 'view-permission'
		]);
		
		Route::post('/view-permission/{permission_id}', [
				'uses' => 'PermissionController@getViewPermission',
				'as' => 'view-permission'
		]);
		
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_PERMISSION], function() {
		/* Add an Permission */
		Route::post('/add-permission', [
				'uses' => 'PermissionController@getAddPermission',
				'as' => 'add-permission'
		]);
		
		Route::get('/add-permission', [
				'uses' => 'PermissionController@getAddPermission',
				'as' => 'add-permission'
		]);
		
		Route::post('/do-add-permission', [
				'uses' => 'PermissionController@postDoAddPermission',
				'as' => 'do-add-permission'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_PERMISSION], function() {
		/* Update an Permission */
		Route::get('/update-permission/{permission_id}', [
				'uses' => 'PermissionController@getUpdatePermission',
				'as' => 'update-permission'
		]);
		
		Route::post('/update-permission/{permission_id}', [
				'uses' => 'PermissionController@getUpdatePermission',
				'as' => 'update-permission'
		]);
		
		Route::post('/do-update-permission/{permission_id}', [
				'uses' => 'PermissionController@postDoUpdatePermission',
				'as' => 'do-update-permission'
		]);
	});

});
