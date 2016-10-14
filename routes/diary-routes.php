<?php
/* ****************************** Diary Item Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_DIARY_ITEM], function() {
		/* View Diary Item */
		Route::get('/view-diary-item/{diary_item_id}', [
				'uses' => 'DiaryItemController@getViewDiaryItem',
				'as' => 'view-diary-item'
		]);
		
		Route::post('/view-diary-item/{diary_item_id}', [
				'uses' => 'DiaryItemController@getViewDiaryItem',
				'as' => 'view-diary-item'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_DIARY_ITEM], function() {
		/* Add an Diary Item */
		Route::post('/add-diary-item/{property_flip_id}', [
				'uses' => 'DiaryItemController@getAddDiaryItem',
				'as' => 'add-diary-item'
		]);
		
		Route::get('/add-diary-item/{property_flip_id}', [
				'uses' => 'DiaryItemController@getAddDiaryItem',
				'as' => 'add-diary-item'
		]);
		
		Route::post('/do-add-diary-item', [
				'uses' => 'DiaryItemController@postDoAddDiaryItem',
				'as' => 'do-add-diary-item'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_DIARY_ITEM], function() {
		/* Update an Diary Item */
		Route::get('/update-diary-item/{diary_item_id}', [
				'uses' => 'DiaryItemController@getUpdateDiaryItem',
				'as' => 'update-diary-item'
		]);
		
		Route::post('/update-diary-item/{diary_item_id}', [
				'uses' => 'DiaryItemController@getUpdateDiaryItem',
				'as' => 'update-diary-item'
		]);
		
		Route::post('/do-update-diary-item/{diary_item_id}', [
				'uses' => 'DiaryItemController@postDoUpdateDiaryItem',
				'as' => 'do-update-diary-item'
		]);
	});
	
	/* Self Allocate Diary Item */
	Route::post('/self-allocate-diary-item/{diary_item_id}', [
			'uses' => 'DiaryItemController@selfAllocateDiaryItem',
			'as' => 'self-allocate-diary-item'
	])->middleware('auth', 'permission:SELF_ALLOCATE_DIARY_ITEM');

});
