<?php
/* ****************************** Attorney Type Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_ATTORNEY_TYPE], function() {
		/* Search Attorney Typees */
		Route::get('/search-attorney-type', [
				'uses' => 'AttorneyTypeController@getSearchAttorneyType',
				'as' => 'search-attorney-type'
		]);
		
		Route::post('/search-attorney-type', [
				'uses' => 'AttorneyTypeController@getSearchAttorneyType',
				'as' => 'search-attorney-type'
		]);
		
		Route::post('/do-search-attorney-type', [
				'uses' => 'AttorneyTypeController@postDoSearchAttorneyType',
				'as' => 'do-search-attorney-type'
		]);
		
		/* View Attorney Type */
		Route::get('/view-attorney-type/{attorney_type_id}', [
				'uses' => 'AttorneyTypeController@getViewAttorneyType',
				'as' => 'view-attorney-type'
		]);
		
		Route::post('/view-attorney-type/{attorney_type_id}', [
				'uses' => 'AttorneyTypeController@getViewAttorneyType',
				'as' => 'view-attorney-type'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_ATTORNEY_TYPE], function() {
		/* Add an Attorney Type */
		Route::post('/add-attorney-type', [
				'uses' => 'AttorneyTypeController@getAddAttorneyType',
				'as' => 'add-attorney-type'
		]);
		
		Route::get('/add-attorney-type', [
				'uses' => 'AttorneyTypeController@getAddAttorneyType',
				'as' => 'add-attorney-type'
		]);
		
		Route::post('/do-add-attorney-type', [
				'uses' => 'AttorneyTypeController@postDoAddAttorneyType',
				'as' => 'do-add-attorney-type'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_ATTORNEY_TYPE], function() {
		/* Update an Attorney Type */
		Route::get('/update-attorney-type/{attorney_type_id}', [
				'uses' => 'AttorneyTypeController@getUpdateAttorneyType',
				'as' => 'update-attorney-type'
		]);
		
		Route::post('/update-attorney-type/{attorney_type_id}', [
				'uses' => 'AttorneyTypeController@getUpdateAttorneyType',
				'as' => 'update-attorney-type'
		]);
		
		Route::post('/do-update-attorney-type/{attorney_type_id}', [
				'uses' => 'AttorneyTypeController@postDoUpdateAttorneyType',
				'as' => 'do-update-attorney-type'
		]);
	});

});
