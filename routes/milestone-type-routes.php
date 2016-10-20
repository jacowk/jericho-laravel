<?php
/* ****************************** Milestone Type Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_MILESTONE_TYPE], function() {
		/* Search Milestone Types */
		Route::get('/search-milestone-type', [
				'uses' => 'MilestoneTypeController@getSearchMilestoneType',
				'as' => 'search-milestone-type'
		]);
		
		Route::post('/search-milestone-type', [
				'uses' => 'MilestoneTypeController@getSearchMilestoneType',
				'as' => 'search-milestone-type'
		]);
		
		/* Pagination */
		Route::get('/do-search-milestone-type', [
				'uses' => 'MilestoneTypeController@postDoSearchMilestoneType',
				'as' => 'do-search-milestone-type'
		]);
		
		Route::post('/do-search-milestone-type', [
				'uses' => 'MilestoneTypeController@postDoSearchMilestoneType',
				'as' => 'do-search-milestone-type'
		]);
		
		/* View Milestone Type */
		Route::get('/view-milestone-type/{milestone_type_id}', [
				'uses' => 'MilestoneTypeController@getViewMilestoneType',
				'as' => 'view-milestone-type'
		]);
		
		Route::post('/view-milestone-type/{milestone_type_id}', [
				'uses' => 'MilestoneTypeController@getViewMilestoneType',
				'as' => 'view-milestone-type'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_MILESTONE_TYPE], function() {
		/* Add an Milestone Type */
		Route::post('/add-milestone-type', [
				'uses' => 'MilestoneTypeController@getAddMilestoneType',
				'as' => 'add-milestone-type'
		]);
		
		Route::get('/add-milestone-type', [
				'uses' => 'MilestoneTypeController@getAddMilestoneType',
				'as' => 'add-milestone-type'
		]);
		
		Route::post('/do-add-milestone-type', [
				'uses' => 'MilestoneTypeController@postDoAddMilestoneType',
				'as' => 'do-add-milestone-type'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_MILESTONE_TYPE], function() {
		/* Update an Milestone Type */
		Route::get('/update-milestone-type/{milestone_type_id}', [
				'uses' => 'MilestoneTypeController@getUpdateMilestoneType',
				'as' => 'update-milestone-type'
		]);
		
		Route::post('/update-milestone-type/{milestone_type_id}', [
				'uses' => 'MilestoneTypeController@getUpdateMilestoneType',
				'as' => 'update-milestone-type'
		]);
		
		Route::post('/do-update-milestone-type/{milestone_type_id}', [
				'uses' => 'MilestoneTypeController@postDoUpdateMilestoneType',
				'as' => 'do-update-milestone-type'
		]);
	});

});
