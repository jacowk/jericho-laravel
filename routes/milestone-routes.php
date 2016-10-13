<?php
/* ****************************** Milestone Routes ****************************** */

/* Update an Milestone */
Route::post('/update-milestone/{milestone_id}', [
		'uses' => 'MilestoneController@getUpdateMilestone',
		'as' => 'update-milestone'
])->middleware('auth', 'permission:UPDATE_MILESTONE');

Route::post('/do-update-milestone/{milestone_id}', [
		'uses' => 'MilestoneController@postDoUpdateMilestone',
		'as' => 'do-update-milestone'
])->middleware('auth', 'permission:UPDATE_MILESTONE');