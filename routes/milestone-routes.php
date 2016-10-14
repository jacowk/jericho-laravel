<?php
/* ****************************** Milestone Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_MILESTONE], function() {
		/* View Milestone */
		Route::get('/view-milestone/{milestone_id}', [
				'uses' => 'MilestoneController@getViewMilestone',
				'as' => 'view-milestone'
		]);
		
		Route::post('/view-milestone/{milestone_id}', [
				'uses' => 'MilestoneController@getViewMilestone',
				'as' => 'view-milestone'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_MILESTONE], function() {
		/* Add an Milestone */
		Route::post('/add-milestone/{property_flip_id}', [
				'uses' => 'MilestoneController@getAddMilestone',
				'as' => 'add-milestone'
		]);
		
		Route::get('/add-milestone/{property_flip_id}', [
				'uses' => 'MilestoneController@getAddMilestone',
				'as' => 'add-milestone'
		]);
		
		Route::post('/do-add-milestone', [
				'uses' => 'MilestoneController@postDoAddMilestone',
				'as' => 'do-add-milestone'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_MILESTONE], function() {
		/* Update an Milestone */
		Route::get('/update-milestone/{milestone_id}', [
				'uses' => 'MilestoneController@getUpdateMilestone',
				'as' => 'update-milestone'
		]);
		
		Route::post('/update-milestone/{milestone_id}', [
				'uses' => 'MilestoneController@getUpdateMilestone',
				'as' => 'update-milestone'
		]);
		
		Route::post('/do-update-milestone/{milestone_id}', [
				'uses' => 'MilestoneController@postDoUpdateMilestone',
				'as' => 'do-update-milestone'
		]);
	});

});