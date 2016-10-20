<?php
/* ****************************** Marital Status Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_MARITAL_STATUS], function() {
		/* Search Marital Statuses */
		Route::get('/search-marital-status', [
				'uses' => 'MaritalStatusController@getSearchMaritalStatus',
				'as' => 'search-marital-status'
		]);
		
		Route::post('/search-marital-status', [
				'uses' => 'MaritalStatusController@getSearchMaritalStatus',
				'as' => 'search-marital-status'
		]);
		
		/* Pagination */
		Route::get('/do-search-marital-status', [
				'uses' => 'MaritalStatusController@postDoSearchMaritalStatus',
				'as' => 'do-search-marital-status'
		]);
		
		Route::post('/do-search-marital-status', [
				'uses' => 'MaritalStatusController@postDoSearchMaritalStatus',
				'as' => 'do-search-marital-status'
		]);
		
		/* View Marital Status */
		Route::get('/view-marital-status/{marital_status_id}', [
				'uses' => 'MaritalStatusController@getViewMaritalStatus',
				'as' => 'view-marital-status'
		]);
		
		Route::post('/view-marital-status/{marital_status_id}', [
				'uses' => 'MaritalStatusController@getViewMaritalStatus',
				'as' => 'view-marital-status'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_MARITAL_STATUS], function() {
		/* Add an Marital Status */
		Route::post('/add-marital-status', [
				'uses' => 'MaritalStatusController@getAddMaritalStatus',
				'as' => 'add-marital-status'
		]);
		
		Route::get('/add-marital-status', [
				'uses' => 'MaritalStatusController@getAddMaritalStatus',
				'as' => 'add-marital-status'
		]);
		
		Route::post('/do-add-marital-status', [
				'uses' => 'MaritalStatusController@postDoAddMaritalStatus',
				'as' => 'do-add-marital-status'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_MARITAL_STATUS], function() {
		/* Update an Marital Status */
		Route::get('/update-marital-status/{marital_status_id}', [
				'uses' => 'MaritalStatusController@getUpdateMaritalStatus',
				'as' => 'update-marital-status'
		]);
		
		Route::post('/update-marital-status/{marital_status_id}', [
				'uses' => 'MaritalStatusController@getUpdateMaritalStatus',
				'as' => 'update-marital-status'
		]);
		
		Route::post('/do-update-marital-status/{marital_status_id}', [
				'uses' => 'MaritalStatusController@postDoUpdateMaritalStatus',
				'as' => 'do-update-marital-status'
		]);
	});

});
