<?php
/* ****************************** Followup Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_FOLLOWUP_ITEM], function() {
		/* View Followup */
		Route::get('/view-followup-item/{followup_id}', [
				'uses' => 'FollowupItemController@getViewFollowupItem',
				'as' => 'view-followup-item'
		]);
		
		Route::post('/view-followup-item/{followup_item_id}', [
				'uses' => 'FollowupItemController@getViewFollowupItem',
				'as' => 'view-followup-item'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_FOLLOWUP_ITEM], function() {
		/* Add an Followup */
		Route::post('/add-followup-item/{diary_item_id}', [
				'uses' => 'FollowupItemController@getAddFollowupItem',
				'as' => 'add-followup-item'
		]);
		
		Route::get('/add-followup-item/{diary_item_id}', [
				'uses' => 'FollowupItemController@getAddFollowupItem',
				'as' => 'add-followup-item'
		]);
		
		Route::post('/do-add-followup-item', [
				'uses' => 'FollowupItemController@postDoAddFollowupItem',
				'as' => 'do-add-followup-item'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_FOLLOWUP_ITEM], function() {
		/* Update an Followup */
		Route::get('/update-followup-item/{followup_item_id}', [
				'uses' => 'FollowupItemController@getUpdateFollowupItem',
				'as' => 'update-followup-item'
		]);
		
		Route::post('/update-followup-item/{followup_item_id}', [
				'uses' => 'FollowupItemController@getUpdateFollowupItem',
				'as' => 'update-followup-item'
		]);
		
		Route::post('/do-update-followup-item/{followup_item_id}', [
				'uses' => 'FollowupItemController@postDoUpdateFollowupItem',
				'as' => 'do-update-followup-item'
		]);
	});

});