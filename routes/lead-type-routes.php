<?php
/* ****************************** Lead Type Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_CONTRACTOR_TYPE], function() {
		/* Search Lead Typees */
		Route::get('/search-lead-type', [
				'uses' => 'LeadTypeController@getSearchLeadType',
				'as' => 'search-lead-type'
		]);
		
		Route::post('/search-lead-type', [
				'uses' => 'LeadTypeController@getSearchLeadType',
				'as' => 'search-lead-type'
		]);
		
		/* Pagination */
		Route::get('/do-search-lead-type', [
				'uses' => 'LeadTypeController@postDoSearchLeadType',
				'as' => 'do-search-lead-type'
		]);
		
		Route::post('/do-search-lead-type', [
				'uses' => 'LeadTypeController@postDoSearchLeadType',
				'as' => 'do-search-lead-type'
		]);
		
		/* View Lead Type */
		Route::get('/view-lead-type/{lead_type_id}', [
				'uses' => 'LeadTypeController@getViewLeadType',
				'as' => 'view-lead-type'
		]);
		
		Route::post('/view-lead-type/{lead_type_id}', [
				'uses' => 'LeadTypeController@getViewLeadType',
				'as' => 'view-lead-type'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_CONTRACTOR_TYPE], function() {
		/* Add an Lead Type */
		Route::post('/add-lead-type', [
				'uses' => 'LeadTypeController@getAddLeadType',
				'as' => 'add-lead-type'
		]);
		
		Route::get('/add-lead-type', [
				'uses' => 'LeadTypeController@getAddLeadType',
				'as' => 'add-lead-type'
		]);
		
		Route::post('/do-add-lead-type', [
				'uses' => 'LeadTypeController@postDoAddLeadType',
				'as' => 'do-add-lead-type'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_CONTRACTOR_TYPE], function() {
		/* Update an Lead Type */
		Route::get('/update-lead-type/{lead_type_id}', [
				'uses' => 'LeadTypeController@getUpdateLeadType',
				'as' => 'update-lead-type'
		]);
		
		Route::post('/update-lead-type/{lead_type_id}', [
				'uses' => 'LeadTypeController@getUpdateLeadType',
				'as' => 'update-lead-type'
		]);
		
		Route::post('/do-update-lead-type/{lead_type_id}', [
				'uses' => 'LeadTypeController@postDoUpdateLeadType',
				'as' => 'do-update-lead-type'
		]);
	});

});
