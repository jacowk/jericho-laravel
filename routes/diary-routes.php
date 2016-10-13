<?php
/* ****************************** Diary Item Routes ****************************** */

/* Add an Diary Item */
Route::post('/add-diary-item/{property_flip_id}', [
		'uses' => 'DiaryItemController@getAddDiaryItem',
		'as' => 'add-diary-item'
])->middleware('auth', 'permission:ADD_DIARY_ITEM');

Route::get('/add-diary-item/{property_flip_id}', [
		'uses' => 'DiaryItemController@getAddDiaryItem',
		'as' => 'add-diary-item'
])->middleware('auth', 'permission:ADD_DIARY_ITEM');

Route::post('/do-add-diary-item', [
		'uses' => 'DiaryItemController@postDoAddDiaryItem',
		'as' => 'do-add-diary-item'
])->middleware('auth', 'permission:ADD_DIARY_ITEM');

/* Update an Diary Item */
Route::get('/update-diary-item/{diary_item_id}', [
		'uses' => 'DiaryItemController@getUpdateDiaryItem',
		'as' => 'update-diary-item'
])->middleware('auth', 'permission:UPDATE_DIARY_ITEM');

Route::post('/update-diary-item/{diary_item_id}', [
		'uses' => 'DiaryItemController@getUpdateDiaryItem',
		'as' => 'update-diary-item'
])->middleware('auth', 'permission:UPDATE_DIARY_ITEM');

Route::post('/do-update-diary-item/{diary_item_id}', [
		'uses' => 'DiaryItemController@postDoUpdateDiaryItem',
		'as' => 'do-update-diary-item'
])->middleware('auth', 'permission:UPDATE_DIARY_ITEM');

/* View Diary Item */
Route::get('/view-diary-item/{diary_item_id}', [
		'uses' => 'DiaryItemController@getViewDiaryItem',
		'as' => 'view-diary-item'
])->middleware('auth', 'permission:VIEW_DIARY_ITEM');

Route::post('/view-diary-item/{diary_item_id}', [
		'uses' => 'DiaryItemController@getViewDiaryItem',
		'as' => 'view-diary-item'
])->middleware('auth', 'permission:VIEW_DIARY_ITEM');

/* Self Allocate Diary Item */
Route::post('/self-allocate-diary-item/{diary_item_id}', [
		'uses' => 'DiaryItemController@selfAllocateDiaryItem',
		'as' => 'self-allocate-diary-item'
])->middleware('auth', 'permission:SELF_ALLOCATE_DIARY_ITEM');