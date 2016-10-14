<?php
/* ****************************** Milestone Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_MILESTONE], function() {
		/* Update an Milestone */
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