<?php
/* ****************************** Diary Item Comment Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_DIARY_ITEM_COMMENT], function() {
		/* View Followup */
		Route::get('/view-diary-item-comment/{followup_id}', [
				'uses' => 'DiaryItemCommentController@getViewDiaryItemComment',
				'as' => 'view-diary-item-comment'
		]);
		
		Route::post('/view-diary-item-comment/{diary_item_comment_id}', [
				'uses' => 'DiaryItemCommentController@getViewDiaryItemComment',
				'as' => 'view-diary-item-comment'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_DIARY_ITEM_COMMENT], function() {
		/* Add an Followup */
		Route::post('/add-diary-item-comment/{diary_item_id}', [
				'uses' => 'DiaryItemCommentController@getAddDiaryItemComment',
				'as' => 'add-diary-item-comment'
		]);
		
		Route::get('/add-diary-item-comment/{diary_item_id}', [
				'uses' => 'DiaryItemCommentController@getAddDiaryItemComment',
				'as' => 'add-diary-item-comment'
		]);
		
		Route::post('/do-add-diary-item-comment', [
				'uses' => 'DiaryItemCommentController@postDoAddDiaryItemComment',
				'as' => 'do-add-diary-item-comment'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_DIARY_ITEM_COMMENT], function() {
		/* Update an Followup */
		Route::get('/update-diary-item-comment/{diary_item_comment_id}', [
				'uses' => 'DiaryItemCommentController@getUpdateDiaryItemComment',
				'as' => 'update-diary-item-comment'
		]);
		
		Route::post('/update-diary-item-comment/{diary_item_comment_id}', [
				'uses' => 'DiaryItemCommentController@getUpdateDiaryItemComment',
				'as' => 'update-diary-item-comment'
		]);
		
		Route::post('/do-update-diary-item-comment/{diary_item_comment_id}', [
				'uses' => 'DiaryItemCommentController@postDoUpdateDiaryItemComment',
				'as' => 'do-update-diary-item-comment'
		]);
	});

});