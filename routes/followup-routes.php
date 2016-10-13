<?php
/* ****************************** Followup Routes ****************************** */

/* Add an Followup */
Route::post('/add-followup-item/{diary_item_id}', [
		'uses' => 'FollowupItemController@getAddFollowupItem',
		'as' => 'add-followup-item'
])->middleware('auth', 'permission:ADD_FOLLOWUP_ITEM');

Route::get('/add-followup-item/{diary_item_id}', [
		'uses' => 'FollowupItemController@getAddFollowupItem',
		'as' => 'add-followup-item'
])->middleware('auth', 'permission:ADD_FOLLOWUP_ITEM');

Route::post('/do-add-followup-item', [
		'uses' => 'FollowupItemController@postDoAddFollowupItem',
		'as' => 'do-add-followup-item'
])->middleware('auth', 'permission:ADD_FOLLOWUP_ITEM');

/* Update an Followup */
Route::get('/update-followup-item/{followup_item_id}', [
		'uses' => 'FollowupItemController@getUpdateFollowupItem',
		'as' => 'update-followup-item'
])->middleware('auth', 'permission:UPDATE_FOLLOWUP_ITEM');

Route::post('/update-followup-item/{followup_item_id}', [
		'uses' => 'FollowupItemController@getUpdateFollowupItem',
		'as' => 'update-followup-item'
])->middleware('auth', 'permission:UPDATE_FOLLOWUP_ITEM');

Route::post('/do-update-followup-item/{followup_item_id}', [
		'uses' => 'FollowupItemController@postDoUpdateFollowupItem',
		'as' => 'do-update-followup-item'
])->middleware('auth', 'permission:UPDATE_FOLLOWUP_ITEM');

/* View Followup */
Route::get('/view-followup-item/{followup_id}', [
		'uses' => 'FollowupItemController@getViewFollowupItem',
		'as' => 'view-followup-item'
])->middleware('auth', 'permission:VIEW_FOLLOWUP_ITEM');

Route::post('/view-followup-item/{followup_item_id}', [
		'uses' => 'FollowupItemController@getViewFollowupItem',
		'as' => 'view-followup-item'
])->middleware('auth', 'permission:VIEW_FOLLOWUP_ITEM');